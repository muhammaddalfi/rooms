<?php

namespace App\Exports;

use App\Models\Baddeb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BaddebExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'ID Pelanggan',
            'Layanan',
            'Status Follow Up',
            'Petugas Collection',
            'Kategori Alasan',
            'Tanggal Follow Up'
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama_pelanggan,
            $row->id_pln,
            $row->layanan,
            $row->status_bayar,
            $row->user->name,
            $row->kategori->name,
            $row->created_at->format('d-m-Y')
        ];
    }

    public function collection()
    {
        return Baddeb::all();
    }
}
