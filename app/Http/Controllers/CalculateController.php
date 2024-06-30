<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\Actual;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
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

        $result = $this->process($actuals, $alpha);

        $result = collect($result);
        $lastData = $result->last();

        $forecasting = $lastData['a'] + ($lastData['b'] * 1); // hitung forecasting
        $mape = $result->sum('percent_e') / count($result); // hitung mape

        // Calculate the forecasts for the next three periods
        $nextForecasts = [];
        for ($i = 1; $i <= $m; $i++) {
            $forecast = $lastData['a'] + ($lastData['b'] * $i);
            $nextForecasts[] = $forecast;
        }

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

    public function process($actuals, $a)
    {
        $result = [];

        foreach ($actuals as $key => $actual) {

            // cek apakah data pertama?
            $isFirst = $key == 0;

            if ($isFirst) {
                $result[$key]['periode'] = $actual->periode;
                $result[$key]['aktual'] = $actual->value;
                $result[$key]['s1'] = $actual->value;
                $result[$key]['s2'] = $actual->value;
                $result[$key]['a'] = $actual->value;
                $result[$key]['b'] = 0;
                $result[$key]['f'] = 0;
                $result[$key]['e'] = 0;
                $result[$key]['abs_e'] = 0;
                $result[$key]['percent_e'] = 0;
            } else {
                // get data sebelumnya
                $prevData = $result[$key - 1];

                $result[$key]['periode'] = $actual->periode;
                $result[$key]['aktual'] = $actual->value;
                $result[$key]['s1'] = ($actual->value * $a) + (1 - $a) * $prevData['s1'];
                $result[$key]['s2'] = ($result[$key]['s1'] * $a) + (1 - $a) * $prevData['s2'];
                $result[$key]['a'] = 2 * $result[$key]['s1'] - $result[$key]['s2'];
                $result[$key]['b'] = $a / (1 - $a) * ($result[$key]['s1'] - $result[$key]['s2']);
                $result[$key]['f'] = $prevData['a'] + ($prevData['b'] * 1);
                $result[$key]['e'] = $actual->value - $result[$key]['f'];
                $result[$key]['abs_e'] = abs($actual->value - $result[$key]['f']);
                $result[$key]['percent_e'] = ($result[$key]['abs_e'] / $actual->value) * 100;
            }
        }

        return $result;
    }
}
