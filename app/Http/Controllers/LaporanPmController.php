<?php

namespace App\Http\Controllers;

use App\Models\Pm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LaporanPmController extends Controller
{
    public function index()
    {
        return view('pm.laporan');
    }

    public function search(Request $request)
    {

        if($request->ajax())
        {
              $data_raw = "SELECT p.*, o.nama_olt as lokasi ,(SELECT u.name FROM users u WHERE id = p.user_id) as nama_petugas
                            FROM pms p
                            LEFT JOIN olts o ON o.id = p.id_lokasi
                            WHERE p.is_olt = '1' AND p.is_feeder = '1' AND p.is_fdt = '1' AND p.is_fat = '1'
                            ORDER BY p.id DESC";
               $data = DB::select($data_raw);

               if($request->filled('from_date') && $request->filled('end_date'))
               {
                    $data_raw = "SELECT p.*, o.nama_olt as lokasi ,(SELECT u.name FROM users u WHERE id = p.user_id) as nama_petugas
                            FROM pms p
                            LEFT JOIN olts o ON o.id = p.id_lokasi
                            WHERE p.is_olt = '1' AND p.is_feeder = '1' AND p.is_fdt = '1' AND p.is_fat = '1'
                            AND (p.tgl_mulai BETWEEN ? AND ?)
                            ORDER BY p.id DESC";
                    $data = DB::select($data_raw,[$request->from_date,$request->end_date]);
               }

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return ' <a href="/montir/pm/laporan/download/' . $data->id . '" class="btn btn-outline-success btn-icon ml-2 pdf" data-id="' . $data->id . '"><i class="ph-file-pdf"></i></a';
            })
            ->rawColumns(['action'])
            ->make(true);
            
        }       
    }

    public function generate($id)
    {
        $laporan = Pm::with(['olt', 'user'])->find($id);
        // dd($laporan);
        if ($laporan) {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('pm.laporan.form', $laporan->toArray());

            return $pdf->stream('PDF_PM_Ritel.pdf', array("Attachment" => false));
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found',
            ]);
        }
    }
}
