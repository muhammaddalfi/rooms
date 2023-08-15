<?php

namespace App\Imports;

use App\Models\Olt;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OltsImport implements ToModel, WithHeadingRow
{
   public function model(array $row)

    {

        return new Olt([

            'nama_olt' => $row['nama_olt'],
            'lat'  => $row['lat'],
            'lng'  => $row['lng'],

        ]);

    }
}
