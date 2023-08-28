<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\Kegiatan;
use App\Models\Keluhan;
use App\Models\Olt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home()
    {
        if (auth()->user()->can('admin read')) {
            
            $tahun = date('Y');
            $bulan = date('m');
            
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;

            //table cluster tanggal detail 
            $db = "SELECT c.nama_olt, date(a.created_at) AS tanggal,
                    COUNT(a.id) AS jumlah_kunjungan
                    FROM dailies a
                    LEFT JOIN users b
                    ON b.id = a.user_id
                    LEFT JOIN olts c ON c.id = a.nama_olt 
                    WHERE YEAR(a.created_at) = ? 
                    AND MONTH(a.created_at) = ?
                    GROUP BY c.nama_olt, tanggal";

            $tes = DB::select($db, [$tahun, $bulan]);
            $daily = [];
            foreach ($tes as $value) {
                $daily[$value->nama_olt][$value->tanggal]  = $value->jumlah_kunjungan;
            }
            $data['daily'] = $daily;
            //table cluster tanggal detail

            //table jenis kegiatan total
            $db_kegiatan = "SELECT d.nama_olt, c.jenis_kegiatan,c.id,
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
            $tes1 = DB::select($db_kegiatan, [$tahun, $bulan]);
            $jenis_kegiatan_count = [];
            foreach ($tes1 as $value) {
                $jenis_kegiatan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            }
            $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
            $data['kegiatan'] = $jenis_kegiatan_count;
            //table jenis kegiatan total


            //table daily total sales
            $daily_user = "SELECT u.name, date(d.created_at) AS tanggal,COUNT(d.id) AS jumlah 
            FROM dailies d LEFT JOIN users u ON u.id = d.user_id WHERE YEAR(d.created_at) = ? 
            AND MONTH(d.created_at) = ? GROUP BY u.name, tanggal";
            $tes2 = DB::select($daily_user,[$tahun, $bulan]);
            $daily_user = [];
              foreach ($tes2 as $value) {
                $daily_user[$value->name][$value->tanggal]  = $value->jumlah;
            }
            $data['daily_user'] = $daily_user;
            //table daily total sales

            //table chart total kegiatan
            $kegiatan_db = "SELECT k.jenis_kegiatan, COUNT(d.id) as jumlah  FROM kegiatans k
                            LEFT JOIN dailies d ON d.kegiatan_id = k.id
                            WHERE YEAR(d.created_at) = ? AND MONTH(d.created_at) =?
                            GROUP BY k.jenis_kegiatan
                            ORDER BY k.jenis_kegiatan";

            $kegiatan_count = DB::select($kegiatan_db, [$tahun, $bulan]);
            $count_kegiatan = [];
            foreach ($kegiatan_count as $value) {
                $count_kegiatan[] = [
                    "name" => $value->jenis_kegiatan,
                    "value" => $value->jumlah
                ];
            }
            $data['jumlah_kegiatan'] = $count_kegiatan;
            //table chart total kegiatan
            
            // count jumlah mpp
            $jumlah_perusahaan_query = "SELECT u.name AS leader_perusahaan,
                                        (SELECT COUNT(id) FROM dailies WHERE YEAR(dailies.created_at) = ? AND MONTH(dailies.created_at) = ? AND user_id IN 
                                            (SELECT id FROM users WHERE id = u.id OR id_leader = u.id)) AS jumlah_perusahaan
                                        FROM users u
                                        WHERE u.jenis_pengguna = 'leader_perusahaan'";

            $data['perusahaan_count'] = DB::select($jumlah_perusahaan_query,[$tahun,$bulan]);
            // count jumlah mpp

            // count jumlah mpi
            $jumlah_internal_query = "SELECT u.name AS leader_internal,
                                            (SELECT COUNT(id) FROM dailies WHERE YEAR(dailies.created_at) = ? AND MONTH(dailies.created_at) = ? AND user_id IN 
                                                (SELECT id FROM users WHERE id = u.id OR id_leader = u.id)) AS jumlah_internal
                                            FROM users u
                                            WHERE u.jenis_pengguna = 'leader_internal'";

                $data['internal_count'] = DB::select($jumlah_internal_query,[$tahun,$bulan]);
            // count jumlah mpi

            $olt = Olt::all();
            $data['total_cluster'] = $olt->count();

            $kegiatan = Kegiatan::all();
            $data['total_kegiatan'] = $kegiatan->count();

            $mpi = User::where('jenis_pengguna', 'leader_internal');
            $data['total_mpi'] = $mpi->count();

            $mpp = User::where('jenis_pengguna', 'leader_perusahaan');
            $data['total_mpp'] = $mpp->count();
            return view('dashboard.index', $data);
        }

        if (auth()->user()->can('leader read')) {
            $mytime = Carbon::now();
            $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $mytime)->format('d-m-Y');
            
            // pie kegiaytan sales 
            $count_kegiatan_sales = [];
            $jumlah_internal_query = "SELECT u.name AS anggota_internal,
	                                (SELECT COUNT(id) FROM dailies WHERE user_id IN (SELECT id FROM users WHERE id = u.id)
                                    AND DATE(dailies.created_at) = CURDATE()) AS jumlah_internal
                                FROM users u
                                WHERE u.id_leader = '".Auth()->user()->id."'";

            $data['internal_count'] = DB::select($jumlah_internal_query);
            $jumlah_kegiatan_count = DB::select($jumlah_internal_query);
            foreach ($jumlah_kegiatan_count as $value) {
                $count_kegiatan_sales[] = [
                    "name" => $value->anggota_internal,
                    "value" => $value->jumlah_internal
                ];
            }
            $data['jumlah_kegiatan_sales'] = $count_kegiatan_sales;
            // pie kegiaytan sales  

            // pie jumlah kegiatan
            $kegiatan_db = "SELECT k.jenis_kegiatan, COUNT(d.id) as jumlah  FROM kegiatans k
                            LEFT JOIN dailies d ON d.kegiatan_id = k.id
                            WHERE DATE(d.created_at) = CURDATE()
                            AND  d.user_id IN (SELECT id FROM users WHERE id_leader = '".Auth()->user()->id."')
                            GROUP BY k.jenis_kegiatan
                            ORDER BY k.jenis_kegiatan";
            
            $count_kegiatan = [];
            $kegiatan_count = DB::select($kegiatan_db);
            foreach ($kegiatan_count as $value) {
                $count_kegiatan[] = [
                    "name" => $value->jenis_kegiatan,
                    "value" => $value->jumlah
                ];
            }
            $data['jumlah_kegiatan'] = $count_kegiatan;
            // pie jumlah kegiatan
            
            // table Cluster
            
            $db_kegiatan = "SELECT d.nama_olt, c.jenis_kegiatan,c.id,
                                COUNT(a.id) AS jumlah_kunjungan
                                FROM dailies a
                                LEFT JOIN users b
                                ON b.id = a.user_id
                                LEFT JOIN kegiatans c ON c.id = a.kegiatan_id
                                LEFT JOIN olts d ON d.id = a.nama_olt
                                WHERE DATE(a.created_at) = CURDATE()
                                AND a.user_id IN (SELECT id FROM users WHERE id_leader = '".Auth()->user()->id."')
                                GROUP BY d.nama_olt,c.jenis_kegiatan,c.id
                                ORDER BY c.id ASC;
                                ";
            
            $tes1 = DB::select($db_kegiatan);
            
            $jenis_kegiatan_count = [];  
            foreach ($tes1 as $value) {
                $jenis_kegiatan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            }          
            $data['kegiatan'] = $jenis_kegiatan_count;
            $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
            // table cluster
           
           
            $olt = Olt::all();
            $data['total_cluster'] = $olt->count();

            $mpi = User::where('jenis_pengguna', 'anggota_internal')
                        ->where('id_leader', auth()->user()->id);
            $data['total_mpi'] = $mpi->count();

            $keluhan = Keluhan::where('user_id',Auth()->user()->id)
                                ->where('created_at','>=', DB::raw('curdate()'));
            $data['total_keluhan'] = $keluhan->count();
            
            $data['tanggal_skr'] = $formatDate;
            return view('dashboard.index', $data);
        }

        if(auth()->user()->can('user read'))
        {

            //                         DB::table('users')
            // ->join('contacts', 'users.id', '=', 'contacts.user_id')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            // ->select('users.*', 'contacts.phone', 'orders.price')
            // ->get();

            $curdate = date('Y-m-d');
            $count_daily_user = DB::table('dailies')
                                    ->select(DB::raw('COUNT(dailies.id)'))
                                    ->leftjoin('users','users.id', '=', 'dailies.user_id')
                                    ->where('users.id', auth()->user()->id)
                                    ->whereDate('dailies.created_at', $curdate);

            // dd($data['daily_user']);
            $data['tampil_jumlah'] = $count_daily_user->count();

            // dd($data['tampil'] = $tes);
            
            return view('dashboard.index',$data);
        }
    }

    public function home_cari(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

         $db = "SELECT c.nama_olt, date(a.created_at) AS tanggal,
                    COUNT(a.id) AS jumlah_kunjungan
                    FROM dailies a
                    LEFT JOIN users b
                 
                    ON b.id = a.user_id
                    LEFT JOIN olts c ON c.id = a.nama_olt 
                    WHERE YEAR(a.created_at) = ? 
                    AND MONTH(a.created_at) = ?
                    GROUP BY c.nama_olt, tanggal";

            $daily_user = "SELECT u.name, date(d.created_at) AS tanggal,COUNT(d.id) AS jumlah FROM dailies d LEFT JOIN users u ON u.id = d.user_id WHERE YEAR(d.created_at) = ? AND MONTH(d.created_at) = ? GROUP BY u.name, tanggal";



            $db_kegiatan = "SELECT d.nama_olt, c.jenis_kegiatan,c.id,
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
                                        (SELECT COUNT(id) FROM dailies WHERE YEAR(dailies.created_at) = ? AND MONTH(dailies.created_at) = ? AND user_id IN 
                                            (SELECT id FROM users WHERE id = u.id OR id_leader = u.id)) AS jumlah_internal
                                        FROM users u
                                        WHERE u.jenis_pengguna = 'leader_internal'";

            $data['internal_count'] = DB::select($jumlah_internal_query,[$tahun,$bulan]);

            $jumlah_perusahaan_query = "SELECT u.name AS leader_perusahaan,
                                        (SELECT COUNT(id) FROM dailies WHERE YEAR(dailies.created_at) = ? AND MONTH(dailies.created_at) = ? AND user_id IN 
                                            (SELECT id FROM users WHERE id = u.id OR id_leader = u.id)) AS jumlah_perusahaan
                                        FROM users u
                                        WHERE u.jenis_pengguna = 'leader_perusahaan'";

            $data['perusahaan_count'] = DB::select($jumlah_perusahaan_query,[$tahun,$bulan]);

            // map view
            $kegiatan_count = DB::select($kegiatan_db, [$tahun, $bulan]);
            $count_kegiatan = [];
            foreach ($kegiatan_count as $value) {
                $count_kegiatan[] = [
                    "name" => $value->jenis_kegiatan,
                    "value" => $value->jumlah
                ];
            }
            $data['jumlah_kegiatan'] = $count_kegiatan;
            // map view

            $tes = DB::select($db, [$tahun, $bulan]);
            $tes2 = DB::select($daily_user,[$tahun, $bulan]);

            $tes1 = DB::select($db_kegiatan, [$tahun, $bulan]);

            $daily = [];
            $jenis_kegiatan_count = [];
            $daily_user = [];

            foreach ($tes as $value) {
                $daily[$value->nama_olt][$value->tanggal]  = $value->jumlah_kunjungan;
            }

            foreach ($tes1 as $value) {
                $jenis_kegiatan_count[$value->nama_olt][$value->id]  = $value->jumlah_kunjungan;
            }

             foreach ($tes2 as $value) {
                $daily_user[$value->name][$value->tanggal]  = $value->jumlah;
            }

            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;

            $data['daily'] = $daily;
            $data['kegiatan'] = $jenis_kegiatan_count;
            $data['daily_user'] = $daily_user;

            $data['jenis_kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
            $olt = Olt::all();
            $data['total_cluster'] = $olt->count();

            $kegiatan = Kegiatan::all();
            $data['total_kegiatan'] = $kegiatan->count();

            $mpi = User::where('jenis_pengguna', 'leader_internal');
            $data['total_mpi'] = $mpi->count();

            $mpp = User::where('jenis_pengguna', 'leader_perusahaan');
            $data['total_mpp'] = $mpp->count();
        return view('dashboard.index', $data);
    }

}

