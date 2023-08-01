<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // select b.`name`, date(a.created_at) AS tanggal,
    // COUNT(a.id) AS jumlah_kunjungan
    // FROM dailies a
    // LEFT JOIN users b
    // ON b.id = a.user_id
    // WHERE YEAR(a.created_at) = '2023' AND MONTH(a.created_at) = '07'
    // GROUP BY a.user_id, tanggal;
    
    public function home()
    {
        $tahun = date('Y');
        $bulan = date('m');

        $db = "select a.nama_olt, date(a.created_at) AS tanggal,
            COUNT(a.id) AS jumlah_kunjungan
            FROM dailies a
            LEFT JOIN users b
            ON b.id = a.user_id
            WHERE YEAR(a.created_at) = ? 
            AND MONTH(a.created_at) = ?
            GROUP BY a.nama_olt, tanggal";

        $db_kegiatan = "select a.nama_olt, c.jenis_kegiatan,c.id,
                        COUNT(a.id) AS jumlah_kunjungan
                        FROM dailies a
                        LEFT JOIN users b
                        ON b.id = a.user_id
                        LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                        WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ?
                        GROUP BY a.nama_olt,c.jenis_kegiatan,c.id
                        ORDER BY c.id ASC;
                        ";

        $tes = DB::select($db,[$tahun,$bulan]);
        $tes1 = DB::select($db_kegiatan,[$tahun,$bulan]);

        $daily = [];
        $jenis_kegiatan = [];

        foreach ($tes as $value) {
            $daily[$value->nama_olt][ $value->tanggal]  = $value->jumlah_kunjungan;
            # code...
        }

        foreach ($tes1 as $value) {
            $jenis_kegiatan[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            # code...
        }

        // die(json_encode($daily));
        //dd($daily);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['daily'] = $daily;
        $data['kegiatan'] = $jenis_kegiatan;
        $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
        return view('dashboard.index',$data);
    }

    public function home_cari(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

         $db = "select a.nama_olt, date(a.created_at) AS tanggal,
            COUNT(a.id) AS jumlah_kunjungan
            FROM dailies a
            LEFT JOIN users b
            ON b.id = a.user_id
            WHERE YEAR(a.created_at) = ? 
            AND MONTH(a.created_at) = ?
            GROUP BY a.nama_olt, tanggal";

        $db_kegiatan = "select a.nama_olt, c.jenis_kegiatan,c.id,
                        COUNT(a.id) AS jumlah_kunjungan
                        FROM dailies a
                        LEFT JOIN users b
                        ON b.id = a.user_id
                        LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                        WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ?
                        GROUP BY a.nama_olt,c.jenis_kegiatan,c.id
                        ORDER BY c.id ASC;
                        ";

        $tes = DB::select($db,[$tahun,$bulan]);
        $tes1 = DB::select($db_kegiatan,[$tahun,$bulan]);

        $daily = [];
        $jenis_kegiatan = [];

        foreach ($tes as $value) {
            $daily[$value->nama_olt][ $value->tanggal]  = $value->jumlah_kunjungan;
            # code...
        }

        foreach ($tes1 as $value) {
            $jenis_kegiatan[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            # code...
        }

        // die(json_encode($daily));
        //dd($daily);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['daily'] = $daily;
        $data['kegiatan'] = $jenis_kegiatan;
        $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
        return view('dashboard.index',$data);
    } 
}
