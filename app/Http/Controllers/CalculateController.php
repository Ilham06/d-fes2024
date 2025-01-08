<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Actual;
use App\Services\CalculateService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class CalculateController extends Controller
{
    protected $calculationService;

    public function __construct(CalculateService $calculationService)
    {
        $this->calculationService = $calculationService;
    }

    public function index()
    {
        return view('pages.calculate.index');
    }

    public function result(CalculateRequest $request)
    {
        $alpha = $request->alpha;
        $m = $request->m;

        $actuals = Actual::all();

        if (!count($actuals)) {
            return redirect()->route('calculate.index')->with('error', 'tidak ditemukan data aktual, harap isi data aktual terlebih dahulu');
        }

        $calculation = $this->calculationService->calculate($actuals, $alpha, $m);
        $result = $calculation['result'];
        $nextForecasts = $calculation['nextForecasts'];
        $mape = $calculation['mape'];

        // data cart
        $chartData = [];
        foreach ($result as $key => $value) {
            $chartData['periode'][] = $value['periode'];
            $chartData['aktual'][] = $value['aktual'];
            $chartData['forecasting'][] = round($value['f']);
        }
        // tambah data peramalan ke chart
        foreach ($nextForecasts as $key => $forecast) {
            $chartData['periode'][] = 'm ' . $key + 1;
            $chartData['forecasting'][] = round($forecast);
        }

        $chartData = json_encode($chartData);

        // Menyimpan data di cache, menggunakan key yang konsisten
        Cache::put('calculation_result', $result, now()->addDays(7)); // Simpan selama 60 menit
        Cache::put('calculation_mape', $mape, now()->addDays(7));
        Cache::put('calculation_nextForecasts', $nextForecasts, now()->addDays(7));
        Cache::put('calculation_chartData', $chartData, now()->addDays(7));
        Cache::put('calculation_alpha', $alpha, now()->addDays(7));
        Cache::put('calculation_m', $m, now()->addDays(7));
        Cache::put('isSaved', false, now()->addDays(7)); // Menandakan bahwa hasil telah disimpan

        return view('pages.calculate.result', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm'));
    }

    public function savedResult()
    {
        // Memeriksa apakah hasil perhitungan ada di cache
        if (!Cache::get('isSaved')) {
            return redirect('/')->with('error', 'Tidak ditemukan data peralaman yang tersimpan');
        }

        // Mengambil data dari cache
        $result = Cache::get('calculation_result');
        $mape = Cache::get('calculation_mape');
        $nextForecasts = Cache::get('calculation_nextForecasts');
        $chartData = Cache::get('calculation_chartData');
        $alpha = Cache::get('calculation_alpha');
        $m = Cache::get('calculation_m');

        // Periksa apakah semua data tersedia
        if (is_null($result) || is_null($mape) || is_null($nextForecasts) || is_null($chartData) || is_null($alpha) || is_null($m)) {
            return redirect()->route('calculate.index')->with('error', 'Data hasil perhitungan tidak ditemukan.');
        }

        return view('pages.calculate.result', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm'));
    }

    public function saved()
    {
        // Mengambil data dari cache
        $result = Cache::get('calculation_result');
        $mape = Cache::get('calculation_mape');
        $nextForecasts = Cache::get('calculation_nextForecasts');
        $chartData = Cache::get('calculation_chartData');
        $alpha = Cache::get('calculation_alpha');
        $m = Cache::get('calculation_m');
        
        // Tandai data sebagai tersimpan
        Cache::put('isSaved', true, now()->addDays(7));

        return view('pages.calculate.result', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm'));
    }

    public function printPDF()
    {
        // Mengambil data dari cache atau session
        $result = Cache::get('calculation_result');
        $mape = Cache::get('calculation_mape');
        $nextForecasts = Cache::get('calculation_nextForecasts');
        $chartData = Cache::get('calculation_chartData');
        $alpha = Cache::get('calculation_alpha');
        $m = Cache::get('calculation_m');

        // Membuat PDF menggunakan view
        $pdf = FacadePdf::loadView('pages.calculate.print_pdf', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm'));

        // Mengunduh file PDF
        return $pdf->download('perhitungan.pdf');
    }
}
