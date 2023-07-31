<?php

namespace App\Http\Controllers;

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
        $tahun = '2023';
        $bulan = '07';

        $db = "select a.user_id as user, date(a.created_at) AS tanggal,
            COUNT(a.id) AS jumlah_kunjungan
            FROM dailies a
            LEFT JOIN users b
            ON b.id = a.user_id
            WHERE YEAR(a.created_at) = ? 
            AND MONTH(a.created_at) = ?
            GROUP BY a.user_id, tanggal";

        $tes = DB::select($db,[$tahun,$bulan]);

        $daily = [];

        foreach ($tes as $value) {
            $daily[$value->user][ $value->tanggal]  = $value->jumlah_kunjungan;
            # code...
        }

        // die(json_encode($daily));
        

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['daily'] = $daily;
        return view('dashboard.index',$data);
    }
}
