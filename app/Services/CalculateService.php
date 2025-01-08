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
                $result[$key]['aktual'] = round($actual->value, 5);
                $result[$key]['s1'] = round($actual->value, 5);
                $result[$key]['s2'] = round($actual->value, 5);
                $result[$key]['a'] = round($actual->value, 5);
                $result[$key]['b'] = 0;
                $result[$key]['f'] = 0;
                $result[$key]['e'] = 0;
                $result[$key]['abs_e'] = 0;
                $result[$key]['percent_e'] = 0;
            } else {
                // get data sebelumnya
                $prevData = $result[$key - 1];

                $result[$key]['periode'] = $actual->periode;
                $result[$key]['aktual'] = round($actual->value, 5);
                $result[$key]['s1'] = round(($actual->value * $a) + (1 - $a) * $prevData['s1'], 5);
                $result[$key]['s2'] = round(($result[$key]['s1'] * $a) + (1 - $a) * $prevData['s2'], 5);
                $result[$key]['a'] = round(2 * $result[$key]['s1'] - $result[$key]['s2'], 5);
                $result[$key]['b'] = round($a / (1 - $a) * ($result[$key]['s1'] - $result[$key]['s2']), 5);
                $result[$key]['f'] = round($prevData['a'] + ($prevData['b'] * 1), 5);
                $result[$key]['e'] = round($actual->value - $result[$key]['f'], 5);
                $result[$key]['abs_e'] = round(abs($actual->value - $result[$key]['f']), 5);
                $result[$key]['percent_e'] = round(($result[$key]['abs_e'] / $actual->value) * 100, 5);
            }
        }

        $result = collect($result);
        $lastData = $result->last();

        $mape = round($result->sum('percent_e') / count($result), 5); // hitung mape

        // hitung peramalan untuk periode berikutnya
        $nextForecasts = [];
        for ($i = 1; $i <= $m; $i++) {
            $forecast = round($lastData['a'] + ($lastData['b'] * $i), 5);
            $nextForecasts[] = $forecast;
        }

        return [
            'result' => $result,
            'nextForecasts' => $nextForecasts,
            'mape' => $mape
        ];
    }
}

