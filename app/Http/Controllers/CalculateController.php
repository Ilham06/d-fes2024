<?php

namespace App\Http\Controllers;

use App\Models\Actual;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function index()
    {
        return view('pages.calculate.index');
    }

    public function result(Request $request)
    {
        $actuals = Actual::all();
        $result = $this->process($actuals, $request->alpha);
        
        $result = collect($result);
        $lastData = $result->last();
        
        $forecasting = $lastData['a'] + ($lastData['b'] * 1); // hitung forecasting
        $mape = $result->sum('percent_e') / count($result); // hitung mape

        dd($mape);
        return view('pages.calculate.result');
    }

    public function process($actuals, $a)
    {
        $arrF = [];

        foreach ($actuals as $key => $actual) {

            // cek apakah data pertama?
            $isFirst = $key == 0;

            if ($isFirst) {
                $arrF[$key]['periode'] = $actual->periode;
                $arrF[$key]['aktual'] = $actual->value;
                $arrF[$key]['s1'] = $actual->value;
                $arrF[$key]['s2'] = $actual->value;
                $arrF[$key]['a'] = $actual->value;
                $arrF[$key]['b'] = 0;
                $arrF[$key]['f'] = 0;
                $arrF[$key]['e'] = 0;
                $arrF[$key]['abs_e'] = 0;
                $arrF[$key]['percent_e'] = 0;
            } else {
                // get data sebelumnya
                $prevData = $arrF[$key - 1];

                $arrF[$key]['periode'] = $actual->periode;
                $arrF[$key]['aktual'] = $actual->value;
                $arrF[$key]['s1'] = ($actual->value * $a) + (1 - $a) * $prevData['s1'];
                $arrF[$key]['s2'] = ($arrF[$key]['s1'] * $a) + (1 - $a) * $prevData['s2'];
                $arrF[$key]['a'] = 2 * $arrF[$key]['s1'] - $arrF[$key]['s2'];
                $arrF[$key]['b'] = $a / (1 - $a) * ($arrF[$key]['s1'] - $arrF[$key]['s2']);
                $arrF[$key]['f'] = $prevData['a'] + ($prevData['b'] * 1);
                $arrF[$key]['e'] = $actual->value - $arrF[$key]['f'];
                $arrF[$key]['abs_e'] = abs($actual->value - $arrF[$key]['f']);
                $arrF[$key]['percent_e'] = ($arrF[$key]['abs_e'] / $actual->value) * 100;
            }
        }

        return $arrF;
    }
}
