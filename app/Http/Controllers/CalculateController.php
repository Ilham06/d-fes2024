<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Actual;
use App\Services\CalculateService;
use Illuminate\Http\Request;

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
            $chartData['periode'][] = 'm '. $key+1;
            $chartData['forecasting'][] = round($forecast);
        }
        
        $chartData = json_encode($chartData);

        return view('pages.calculate.result', compact('result', 'mape', 'nextForecasts', 'chartData', 'alpha', 'm'));
    }

}
