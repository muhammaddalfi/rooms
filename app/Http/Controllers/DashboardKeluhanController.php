<?php

namespace App\Http\Controllers;

use App\Models\Jenis_keluhan;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardKeluhanController extends Controller
{

    public function home(){

        $tahun = date('Y');
        $bulan = date('m');

        $db_keluhan = "SELECT o.nama_olt, jk.jenis_keluhan,jk.id,
                                COUNT(k.id) AS jumlah_kunjungan
                                FROM keluhans k
                                LEFT JOIN users u ON u.id = k.user_id
                                LEFT JOIN jenis_keluhans jk ON jk.id = k.keluhan_id
                                LEFT JOIN olts o ON o.id = k.nama_olt
                                WHERE YEAR(k.created_at) = ? AND MONTH(k.created_at) = ?
                                GROUP BY o.nama_olt,jk.jenis_keluhan,jk.id
                                ORDER BY jk.id ASC";

         $jumlah_keluhan_query = "SELECT o.nama_olt AS nama_olt,
                                    (SELECT COUNT(id) FROM keluhans WHERE YEAR(keluhans.created_at) = ? AND MONTH(keluhans.created_at) = ? AND user_id IN (SELECT id FROM users WHERE id = o.id OR id_leader = o.id)) AS jumlah_keluhan
                                    FROM olts o";

        $data['keluhan_count'] = DB::select($jumlah_keluhan_query,[$tahun,$bulan]);
        
        $data['jenis_keluhan'] = Jenis_keluhan::orderBy('id', 'ASC')->get();
        $tes1 = DB::select($db_keluhan, [$tahun, $bulan]);
        $jenis_keluhan_count = [];

        foreach ($tes1 as $value) {
                $jenis_keluhan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
        }

        // map view
            $db_keluhan = "SELECT jk.jenis_keluhan, COUNT(k.id) as jumlah  FROM jenis_keluhans jk
            LEFT JOIN keluhans k ON k.keluhan_id = jk.id
            WHERE YEAR(k.created_at) = ? AND MONTH(k.created_at) = ?
            GROUP BY jk.jenis_keluhan
            ORDER BY jk.jenis_keluhan";
            
            $jumlah_keluhan = DB::select($db_keluhan, [$tahun, $bulan]);
            $count_keluhan = [];
            foreach ($jumlah_keluhan as $value) {
                $count_keluhan[] = [
                    "name" => $value->jenis_keluhan,
                    "value" => $value->jumlah
                ];
            }
            $data['jumlah_keluhan'] = $count_keluhan;
        // map view

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['keluhan'] = $jenis_keluhan_count;

        
        return view('dashboard.keluhan',$data);
    }

     public function home_cari(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $db_keluhan = "SELECT o.nama_olt, jk.jenis_keluhan,jk.id,
                                COUNT(k.id) AS jumlah_kunjungan
                                FROM keluhans k
                                LEFT JOIN users u ON u.id = k.user_id
                                LEFT JOIN jenis_keluhans jk ON jk.id = k.keluhan_id
                                LEFT JOIN olts o ON o.id = k.nama_olt
                                WHERE YEAR(k.created_at) = ? AND MONTH(k.created_at) = ?
                                GROUP BY o.nama_olt,jk.jenis_keluhan,jk.id
                                ORDER BY jk.id ASC";

        $jumlah_keluhan_query = "SELECT o.nama_olt AS nama_olt,
                                    (SELECT COUNT(id) FROM keluhans WHERE YEAR(keluhans.created_at) = ? AND MONTH(keluhans.created_at) = ? AND user_id IN (SELECT id FROM users WHERE id = o.id OR id_leader = o.id)) AS jumlah_keluhan
                                    FROM olts o";
        $data['keluhan_count'] = DB::select($jumlah_keluhan_query,[$tahun,$bulan]);
        
        $data['jenis_keluhan'] = Jenis_keluhan::orderBy('id', 'ASC')->get();
        $tes1 = DB::select($db_keluhan, [$tahun, $bulan]);
        $jenis_keluhan_count = [];

        foreach ($tes1 as $value) {
                $jenis_keluhan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
        }

        // map view
            $db_keluhan = "SELECT jk.jenis_keluhan, COUNT(k.id) as jumlah  FROM jenis_keluhans jk
            LEFT JOIN keluhans k ON k.keluhan_id = jk.id
            WHERE YEAR(k.created_at) = ? AND MONTH(k.created_at) = ?
            GROUP BY jk.jenis_keluhan
            ORDER BY jk.jenis_keluhan";
            
            $jumlah_keluhan = DB::select($db_keluhan, [$tahun, $bulan]);
            $count_keluhan = [];
            foreach ($jumlah_keluhan as $value) {
                $count_keluhan[] = [
                    "name" => $value->jenis_keluhan,
                    "value" => $value->jumlah
                ];
            }
            $data['jumlah_keluhan'] = $count_keluhan;
        // map view

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['keluhan'] = $jenis_keluhan_count;
         
        return view('dashboard.keluhan', $data);
    }
}
