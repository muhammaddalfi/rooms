<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Olt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home()
    {
        if (auth()->user()->can('admin read')) {
            $tahun = date('Y');
            $bulan = date('m');


            $db = "select c.nama_olt, date(a.created_at) AS tanggal,
                    COUNT(a.id) AS jumlah_kunjungan
                    FROM dailies a
                    LEFT JOIN users b
                 
                    ON b.id = a.user_id
                    LEFT JOIN olts c ON c.id = a.nama_olt 
                    WHERE YEAR(a.created_at) = ? 
                    AND MONTH(a.created_at) = ?
                    GROUP BY c.nama_olt, tanggal";


            $db_kegiatan = "select d.nama_olt, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b
                                ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ?
                                GROUP BY d.nama_olt,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

            $kegiatan_db = "SELECT k.jenis_kegiatan, COUNT(d.id) as jumlah  FROM kegiatans k
            LEFT JOIN dailies d ON d.kegiatan_id = k.id
            WHERE YEAR(d.created_at) = ? AND MONTH(d.created_at) =?
            GROUP BY k.jenis_kegiatan
            ORDER BY k.jenis_kegiatan";

           $jumlah_internal_query = "SELECT u.name AS leader_internal,
	                                (SELECT COUNT(id) FROM dailies WHERE user_id IN (SELECT id FROM users WHERE id = u.id OR id_leader = u.id
                                        AND YEAR(dailies.created_at) = '.$tahun.' AND MONTH(dailies.created_at) = '.$bulan.' )) AS jumlah_internal
                                FROM users u
                                WHERE u.jenis_pengguna = 'leader_internal'";

            $data['internal_count'] = DB::select($jumlah_internal_query);

            $jumlah_perusahaan_query = "SELECT u.name AS leader_perusahaan,
	                                (SELECT COUNT(id) FROM dailies WHERE user_id IN (SELECT id FROM users WHERE id = u.id OR id_leader = u.id
                                        AND YEAR(dailies.created_at) = '.$tahun.' AND MONTH(dailies.created_at) = '.$bulan.')) AS jumlah_perusahaan
                                FROM users u
                                WHERE u.jenis_pengguna = 'leader_perusahaan'";

            $data['perusahaan_count'] = DB::select($jumlah_perusahaan_query);

            $marketing_db = "SELECT u.name, COUNT(d.id) as jumlah  FROM users u
            LEFT JOIN dailies d ON d.user_id = u.id
            WHERE YEAR(d.created_at) = ? AND MONTH(d.created_at) =? AND u.jenis_pengguna = 'mpi'
            GROUP BY u.name
            ";


            $kegiatan_count = DB::select($kegiatan_db, [$tahun, $bulan]);

            $count_kegiatan = [];
            foreach ($kegiatan_count as $value) {
                $count_kegiatan[] = [
                    "name" => $value->jenis_kegiatan,
                    "value" => $value->jumlah
                ];
                # code...
            }

            $data['jumlah_kegiatan'] = $count_kegiatan;
            $marketing_count = DB::select($marketing_db, [$tahun, $bulan]);

            $data['kegiatan_count'] = $kegiatan_count;
            $data['marketing_count'] = $marketing_count;

            $tes = DB::select($db, [$tahun, $bulan]);
            $tes1 = DB::select($db_kegiatan, [$tahun, $bulan]);

            $daily = [];
            $jenis_kegiatan_count = [];

            foreach ($tes as $value) {
                $daily[$value->nama_olt][$value->tanggal]  = $value->jumlah_kunjungan;
            }

            foreach ($tes1 as $value) {
                $jenis_kegiatan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            }

            $olt = Olt::all();
            $data['total_cluster'] = $olt->count();

            $kegiatan = Kegiatan::all();
            $data['total_kegiatan'] = $kegiatan->count();

            $mpi = User::where('jenis_pengguna', 'leader_internal');
            $data['total_mpi'] = $mpi->count();

            $mpp = User::where('jenis_pengguna', 'leader_perusahaan');
            $data['total_mpp'] = $mpp->count();

            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;

            $data['daily'] = $daily;
            $data['kegiatan'] = $jenis_kegiatan_count;

            $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
        }


        return view('dashboard.index', $data);
    }

    public function home_cari(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if (auth()->user()->can('admin read')) {
            $db = "select c.nama_olt, date(a.created_at) AS tanggal,
                    COUNT(a.id) AS jumlah_kunjungan
                    FROM dailies a
                    LEFT JOIN users b
                 
                    ON b.id = a.user_id
                    LEFT JOIN olts c ON c.id = a.nama_olt 
                    WHERE YEAR(a.created_at) = ? 
                    AND MONTH(a.created_at) = ?
                    GROUP BY c.nama_olt, tanggal";


            $db_kegiatan = "select d.nama_olt, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b
                                ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ?
                                GROUP BY d.nama_olt,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

            $pic_perusahaan = "select b.name, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ? AND b.jenis_pengguna = 'leader_perusahaan'
                                GROUP BY b.name,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

            $pic_upline = "select b.name, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ? AND b.jenis_pengguna = 'leader_internal'
                                GROUP BY b.name,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

            $kegiatan_db = "SELECT k.jenis_kegiatan, COUNT(d.id) as jumlah  FROM kegiatans k
            LEFT JOIN dailies d ON d.kegiatan_id = k.id
            WHERE YEAR(d.created_at) = ? AND MONTH(d.created_at) =?
            GROUP BY k.jenis_kegiatan
            ORDER BY k.jenis_kegiatan
            ";

          $jumlah_internal_query = "SELECT u.name AS leader_internal,
	                                (SELECT COUNT(id) FROM dailies WHERE user_id IN (SELECT id FROM users WHERE id = u.id OR id_leader = u.id
                                        ) AND YEAR(dailies.created_at) = $tahun AND MONTH(dailies.created_at) = $bulan) AS jumlah_internal
                                FROM users u
                                WHERE u.jenis_pengguna = 'leader_internal'";

            $data['internal_count'] = DB::select($jumlah_internal_query);

            $jumlah_perusahaan_query = "SELECT u.name AS leader_perusahaan,
	                                (SELECT COUNT(id) FROM dailies WHERE user_id IN (SELECT id FROM users WHERE id = u.id OR id_leader = u.id
                                        ) AND YEAR(dailies.created_at) = $tahun AND MONTH(dailies.created_at) = $bulan) AS jumlah_perusahaan
                                FROM users u
                                WHERE u.jenis_pengguna = 'leader_perusahaan'";

            $data['perusahaan_count'] = DB::select($jumlah_perusahaan_query);

            // dd($internal_count);

            $marketing_db = "SELECT u.name, COUNT(d.id) as jumlah  FROM users u
            LEFT JOIN dailies d ON d.user_id = u.id
            WHERE YEAR(d.created_at) = ? AND MONTH(d.created_at) =? AND u.jenis_pengguna = 'mpi'
            GROUP BY u.name
            ";


            $kegiatan_count = DB::select($kegiatan_db, [$tahun, $bulan]);

            $count_kegiatan = [];
            foreach ($kegiatan_count as $value) {
                $count_kegiatan[] = [
                    "name" => $value->jenis_kegiatan,
                    "value" => $value->jumlah
                ];
                # code...
            }

            // dd($count_kegiatan);
            $data['jumlah_kegiatan'] = $count_kegiatan;

            // $perusahaan_count = DB::select($perusahaan_db, [$tahun, $bulan]);
            $marketing_count = DB::select($marketing_db, [$tahun, $bulan]);

            // dd($kegiatan_count);

            // //Table Counting
            $data['kegiatan_count'] = $kegiatan_count;
            // $data['perusahaan_count'] = $perusahaan_count;
            $data['marketing_count'] = $marketing_count;
        }

        if (auth()->user()->can('user read')) {

            $db = "select c.nama_olt, date(a.created_at) AS tanggal,
                    COUNT(a.id) AS jumlah_kunjungan
                    FROM dailies a
                    LEFT JOIN users b
                    ON b.id = a.user_id
                    LEFT JOIN olts c ON c.id = a.nama_olt
                    WHERE YEAR(a.created_at) = ? 
                    AND MONTH(a.created_at) = ?
                    AND  a.user_id = " . auth()->user()->id . "
                    GROUP BY c.nama_olt, tanggal";


            $db_kegiatan = "select d.nama_olt, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b
                                ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ?
                                AND  a.user_id = " . auth()->user()->id . "
                                GROUP BY d.nama_olt,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

                                
            $pic_upline = "select b.name, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ? AND b.jenis_pengguna = 'leader_internal'
                                GROUP BY b.name,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

            $pic_perusahaan = "select b.leader, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE YEAR(a.created_at) = ? AND MONTH(a.created_at) = ? AND b.jenis_pengguna = 'mpp' AND  a.user_id = " . auth()->user()->id . "
                                GROUP BY b.leader,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";

          
        }

        $tes = DB::select($db, [$tahun, $bulan]);
        $tes1 = DB::select($db_kegiatan, [$tahun, $bulan]);
        $perusahaan_query = DB::select($pic_perusahaan, [$tahun, $bulan]);
        $upline_query = DB::select($pic_upline, [$tahun, $bulan]);

        $daily = [];
        $jenis_kegiatan_count = [];
        $perusahaan = [];
        $upline = [];

        foreach ($tes as $value) {
            $daily[$value->nama_olt][$value->tanggal]  = $value->jumlah_kunjungan;
            # code...
        }

        foreach ($tes1 as $value) {
            $jenis_kegiatan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            # code...
        }

        $olt = Olt::all();
        $data['total_cluster'] = $olt->count();

        $kegiatan = Kegiatan::all();
        $data['total_kegiatan'] = $kegiatan->count();

        $mpi = User::where('jenis_pengguna', 'leader_internal');
        $data['total_mpi'] = $mpi->count();

        $mpp = User::where('jenis_pengguna', 'ledaer_perusahaan');
        $data['total_mpp'] = $mpp->count();

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        //Table Counting By Jenis Kegiatan
        $data['daily'] = $daily;
        $data['kegiatan'] = $jenis_kegiatan_count;
        // $data['perusahaan'] = $perusahaan;
        // $data['upline'] = $upline;

        $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
        return view('dashboard.index', $data);
    }
}

