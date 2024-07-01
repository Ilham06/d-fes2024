<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResultExport implements FromCollection, WithMapping, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function map($actuals): array
    {
        return [
            $actuals->periode,
            $actuals->value
        ];
    }

    public function headings(): array
    {
        return [
            'Periode',
            'Data',
        ];
    }
}
