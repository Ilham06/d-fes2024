<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Actual;
use App\Models\Forecasting;
use App\Models\Product;
use App\Services\CalculateService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Storage;

class CalculateController extends Controller
{
    protected $calculationService;

    public function __construct(CalculateService $calculationService)
    {
        $this->calculationService = $calculationService;
    }

    public function index()
    {
        $products = Product::all();

        return view('pages.calculate.index', compact('products'));
    }

    public function result(CalculateRequest $request)
    {
        $alpha = $request->alpha;
        $product_id = $request->product_id;
        $m = 1;

        $actuals = Actual::whereProductId($product_id)->get();

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

        $pdf = FacadePdf::loadView('pages.calculate.print_pdf', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm'));
        $fileName = uniqid() . '.pdf';
        
        Storage::put('public/forecasts/' . $fileName, $pdf->output());
        $path = 'forecasts/' . $fileName;

        $record = Forecasting::create([
            'product_id' => $product_id,
            'value' => $nextForecasts[0],
            'path' => $path,
        ]);

        return view('pages.calculate.result', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm', 'record'));
    }

    public function saved(Request $request)
    {
        $forecasting = Forecasting::findOrFail($request->id);
        $forecasting->update([
            'is_saved' => true
        ]);

        return redirect()->route('forecasting.index');
    }

}
