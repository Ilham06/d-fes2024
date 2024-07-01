<?php

namespace App\Exports;

use App\Models\Actual;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActualExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Actual::all();
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
