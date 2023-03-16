<?php

namespace App\Imports;

use App\Models\Costume;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class CostumesImport implements ToModel
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Costume([
            'name' => $row[0],
            'category_id' => $row[1],
            'ld' => $row[3],
            'lp' => $row[4],
            'sizes' => $row[2],
            'price' => $row[5],
        ]);
    }
}
