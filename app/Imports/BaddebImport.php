<?php

namespace App\Imports;

use App\Models\Baddeb;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BaddebImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Baddeb([
            //
            'nama_pelanggan' => $row['nama_pelanggan'],
            'id_pln' => $row['id_pln'],
            'telp'  => $row['telp'],
            'user_id'  => $row['user_id'],
            'keterangan'  => $row['keterangan'],
            'created_at'  => $row['created_at']
        ]);
    }
}
