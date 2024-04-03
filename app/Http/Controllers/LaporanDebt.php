<?php

namespace App\Http\Controllers;

use App\DataTables\BaddebsDataTable;
use App\Exports\BaddebExport;
use App\Models\Baddeb;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class LaporanDebt extends Controller
{
    public function index(){
        return view('baddeb.laporan');
        // return $dataTable->render('baddeb.laporan');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {        
            $year = date('Y');
            $month = date('m');
            if(Auth::user()->hasRole(['admin','management'])){
                $data = Baddeb::all();
                if($request->filled('from_date') && $request->filled('end_date'))
                {
                        $data_raw = "SELECT b.id, b.nama_pelanggan,b.id_pln, b.layanan, b.status_bayar, b.created_at,
                                        (SELECT u.name FROM users u WHERE id = b.user_id) AS nama_petugas
                                        FROM baddebs b
                                        WHERE status_bayar IN('close','pending')
                                        AND created_at BETWEEN ? AND ? 
                                        ORDER BY id DESC";
                        $data = DB::select($data_raw,[$request->from_date,$request->end_date]);
                }
            }

            if(Auth::user()->hasRole(['collection'])){
                $data = Baddeb::where('user_id', auth()->user()->id)
                ->get();
                if($request->filled('from_date') && $request->filled('end_date'))
                {
                        $data_raw = "SELECT b.id, b.nama_pelanggan,b.id_pln, b.layanan, b.status_bayar, b.created_at,
                                        (SELECT u.name FROM users u WHERE id = b.user_id) AS nama_petugas
                                        FROM baddebs b
                                        WHERE status_bayar IN('close','pending')
                                        AND created_at BETWEEN ? AND ? 
                                        AND b.user_id = '".Auth()->user()->id."'
                                        ORDER BY id DESC";
                        $data = DB::select($data_raw,[$request->from_date,$request->end_date]);
                }
            }
                
                
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                if($data->status_bayar == 'close'){
                        return '<span class="badge bg-success">Close</span>';
                    }
                    else if($data->status_bayar == 'pending'){
                        return '<span class="badge bg-warning">Pending</span>';
                    }
                })
                 ->addColumn('created_at', function ($data) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                return $formatDate;
                })
                // ->addColumn('action', function ($data) {
                // if(auth()->user()->can('piutang edit')){
                //      return '<a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $data->id . '"><i class="ph-eye"></i></a>';
                // }else{
                //     return '';
                // }
                // })
                ->rawColumns(['status, tanggal'])
                ->make(true);
                
        }

        if(Auth::user()->hasRole(['collection'])){
            $data = Baddeb::where('user_id', auth()->user()->id)->get();
        }
            
    }

    public function show($id)
    {
        $show = Baddeb::with(['user', 'kategori'])->find($id);
        if ($show) {
            return response()->json([
                'status' => 200,
                'show' => $show
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Daily not found',
            ]);
        }
    }

    public function export()
    {
        return Excel::download(new BaddebExport, 'laporan.xlsx');
    }
}
