<?php

namespace App\Http\Controllers;

use App\Models\Baddeb;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LaporanDebt extends Controller
{
    public function index(){
        return view('baddeb.laporan');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
               $data = Baddeb::where('user_id', auth()->user()->id)
               ->whereNotIn('status_bayar', ['close'])->get();
               if($request->filled('from_date') && $request->filled('end_date'))
               {
                    // $data_raw = "SELECT *
                    //             FROM baddebs 
                    //             WHERE status_bayar NOT IN('close')
                    //             AND created_at BETWEEN ? AND ?
                    //             ORDER BY id DESC";
                    $data_raw = "SELECT b.id, b.nama_pelanggan,b.id_pln, b.layanan, b.status_bayar, 
                                    (SELECT u.name FROM users u WHERE id = b.user_id) AS nama_petugas
                                    FROM baddebs b
                                    WHERE status_bayar IN('close')
                                    AND created_at BETWEEN ? AND ?
                                    AND b.user_id = '".Auth()->user()->id."'
                                    ORDER BY id DESC";
                    $data = DB::select($data_raw,[$request->from_date,$request->end_date]);
               }
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
            
        }       
    }
}
