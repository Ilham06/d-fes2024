<?php

namespace App\Services;

class CalculateService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function calculate($actuals, $a, $m) 
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

        $result = collect($result);
        $lastData = $result->last();

        $mape = $result->sum('percent_e') / count($result); // hitung mape

        // hitung peramalan untuk periode berikutnya
        $nextForecasts = [];
        for ($i = 1; $i <= $m; $i++) {
            $forecast = $lastData['a'] + ($lastData['b'] * $i);
            $nextForecasts[] = $forecast;
        }

        return [
            'result' => $result,
            'nextForecasts' => $nextForecasts,
            'mape' => $mape
        ];
    }
    
}
