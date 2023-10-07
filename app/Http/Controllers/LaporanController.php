<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class LaporanController extends Controller
{
    //
    public function index(){
        $data['sales'] = User::whereNotNull('id_leader')->get();
        return view('laporan.index',$data);
    }

    public function search(Request $request)
    {

        if($request->ajax())
        {
              $data_raw = "SELECT d.*, d.created_at AS tanggal, u.name AS nama_sales, o.nama_olt AS nama_olt, k.jenis_kegiatan
                            FROM dailies d
                            LEFT JOIN users u ON u.id = d.user_id
                            LEFT JOIN olts o ON o.id = d.nama_olt
                            LEFT JOIN kegiatans k ON k.id = d.kegiatan_id
                            ORDER BY d.id DESC";
               $data = DB::select($data_raw);

               if($request->filled('from_date') && $request->filled('end_date'))
               {
                    $data_raw = "SELECT d.*, d.created_at AS tanggal, u.name AS nama_sales, o.nama_olt AS nama_olt, k.jenis_kegiatan
                            FROM dailies d
                            LEFT JOIN users u ON u.id = d.user_id
                            LEFT JOIN olts o ON o.id = d.nama_olt
                            LEFT JOIN kegiatans k ON k.id = d.kegiatan_id
                            WHERE (d.created_at BETWEEN ? AND ?)
                            ORDER BY d.id DESC";
                    $data = DB::select($data_raw,[$request->from_date,$request->end_date]);
               }
            
            //    return DataTables::of($data)->addIndexColumn()->make(true);
            // dd($data);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($data) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                return $formatDate;
            })
            ->addColumn('gambar', function ($data) {
                $images = asset("storage/files/$data->gambar");
                return '<img src="' . $images . '" style="height: 100px; width: 150px;"/>';
            })

            ->addColumn('action', function ($data) {
                if(auth()->user()->can('read-dashboard-cluster') && auth()->user()->can('read-dashboard-keluhan')){
                     return '
                        <a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $data->id . '"><i class="ph-eye"></i></a>';
                }else{
                    return '
                        <a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $data->id . '"><i class="ph-eye"></i></a>';
                }
               
            })

            ->rawColumns(['action', 'gambar'])
            ->make(true);
            
        }



       
    }
}
