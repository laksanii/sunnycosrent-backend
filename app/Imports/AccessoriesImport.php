<?php

namespace App\Imports;

use App\Models\Accessory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccesoriesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Accessory([
            'name' => $row['nama'],
            'price' => $row['price'],
            'costume_id' => $row['costume_id'],
        ]);
    }
}
