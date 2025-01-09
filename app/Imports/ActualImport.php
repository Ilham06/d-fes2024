<?php

namespace App\Imports;

use App\Models\Actual;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ActualImport implements ToModel, WithValidation, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'periode' => 'required',
            'data' => 'required|integer',
            'produk' => 'required'
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Actual([
            'periode'  => $row['periode'],
            'value' => $row['data'],
            'product_id' => $row['produk']
        ]);
    }
}
