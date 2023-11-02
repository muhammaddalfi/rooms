<?php

namespace App\Http\Controllers;

use App\Models\Pm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardMontir extends Controller
{
    //
    public function home()
    {
        if(Auth::user()->hasRole(['admin','management'])){

            // Kategori Pie
            $query_pm_cluster = "SELECT o.nama_olt,COUNT(p.id) AS JUMLAH_PM
                                FROM pms p
                                LEFT JOIN olts o ON o.id = p.id_lokasi
                                GROUP BY  o.nama_olt";
            $query_count = DB::select($query_pm_cluster);
                $count_pm_cluster = [];
                foreach ($query_count as $value) {
                    $count_pm_cluster[] = [
                        "name" => $value->nama_olt,
                        "value" => $value->JUMLAH_PM
                    ];
                }
            $data['jumlah_cluster_pm'] = $count_pm_cluster;
            // Kategori Pie


            $data['plan_pm'] = Pm::where('is_olt','=','0')
                                ->where('is_feeder','=','0')
                                ->where('is_fdt','=','0')
                                ->where('is_fat','=','0')
                                ->count();

            $data['total_pm'] = Pm::count();

            $query_petugas = "SELECT o.nama_olt as lokasi ,(SELECT u.name FROM users u WHERE id = p.user_id) as nama_petugas,
                                p.tgl_mulai
                                FROM pms p
                                LEFT JOIN olts o ON o.id = p.id_lokasi
                                WHERE p.is_olt = '0' AND p.is_feeder = '0' AND p.is_fdt = '0' AND p.is_fat = '0'";
            $data['petugas_pm'] = DB::select($query_petugas);

            return view('dashboard.montir.index',$data);
        }
    }
}
