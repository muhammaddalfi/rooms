<?php

namespace App\Http\Controllers;

use App\Models\Jenis_keluhan;
use App\Models\Kegiatan;
use App\Models\Keluhan;
use App\Models\Olt;
use App\Models\Radiusmap;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KeluhanController extends Controller
{
    //

    public function home()
    {
        $data['jenis_keluhan'] = Jenis_keluhan::all();
        $data['olt'] = Olt::all();
        return view('keluhan.index',$data);
    }

    public function reload_olt($lat, $lng)
    {
        $setting = Radiusmap::where('kode_setting', 'RADIUS_MAP')->first();
        $olts = Olt::select(
            "olts.id",
            "olts.nama_olt",
            "olts.lat",
            "olts.lng",
            DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(olts.lat)) 
                        * cos(radians(olts.lng) - radians(" . $lng . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(olts.lat))) AS distance")
        )->orderBy("distance", "ASC")
            ->having('distance', '<', $setting->value_setting) //radius
            ->get();

        $data['setting_radius'] = $setting->value_setting * 1000;
        $data['olts'] = $olts;

        return $data;
    }

    public function store(Request $request)
    {

        $rule = [
            'latNow' => 'required',
            'lngNow' => 'required',
            'kategori' => 'required',
            'olt' => 'required',
            'keluhan' => 'required',
            'image_compressed' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ];

        $message = [
            'latNow.required' => 'This field is required',
            'lngNow.required' => 'This field is required',
            'olt.required' => 'This field is required',
            'kategori.required' => 'This field is required',
            'keluhan.required' => 'This field is required',
            'image_compressed.required' => 'This field is required',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $path = 'files/';
            $gambar = $request->file('image_compressed');
            $format_name_images = time() . '.' . $gambar->extension();
            $gambar->storeAs($path, $format_name_images, 'public');

            $ajax = new Keluhan();
            $ajax->user_id = auth()->user()->id;
            $ajax->lat = $request->input('latNow');
            $ajax->lng = $request->input('lngNow');
            $ajax->kategori_dinas = $request->input('kategori');
            $ajax->nama_olt = $request->input('olt');
            $ajax->keluhan_id = $request->input('keluhan');
            $ajax->catatan = $request->input('catatan');
            $ajax->gambar = $format_name_images;
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil ditambahkan',
            ]);
        }
    }

    public function keluhan()
    {
        if(Auth::user()->hasRole('sales')){
             $keluhan_raw = "SELECT k.*, u.name AS nama_sales, o.nama_olt AS nama_olt, jk.jenis_keluhan
                            FROM keluhans k
                            LEFT JOIN users u ON u.id = k.user_id
                            LEFT JOIN olts o ON o.id = k.nama_olt
                            LEFT JOIN jenis_keluhans jk ON jk.id = k.keluhan_id
                            WHERE k.user_id IN (SELECT id FROM users WHERE id_leader = '".Auth()->user()->id."')
                            ORDER BY k.id DESC";
            $keluhan = DB::select($keluhan_raw);
        }

        else if(Auth::user()->hasRole('mitra')){
            $keluhan_raw = "SELECT k.*, u.name AS nama_sales, o.nama_olt AS nama_olt, jk.jenis_keluhan
                            FROM keluhans k
                            LEFT JOIN users u ON u.id = k.user_id
                            LEFT JOIN olts o ON o.id = k.nama_olt
                            LEFT JOIN jenis_keluhans jk ON jk.id = k.keluhan_id
                            WHERE k.user_id = '".Auth()->user()->id."'
                            ORDER BY k.id DESC";
            $keluhan = DB::select($keluhan_raw);
        }
        else if(Auth::user()->hasRole(['admin','management'])){
            $keluhan_raw = "SELECT k.*, u.name AS nama_sales, o.nama_olt AS nama_olt, jk.jenis_keluhan
                            FROM keluhans k
                            LEFT JOIN users u ON u.id = k.user_id
                            LEFT JOIN olts o ON o.id = k.nama_olt
                            LEFT JOIN jenis_keluhans jk ON jk.id = k.keluhan_id
                            ORDER BY k.id DESC";
            $keluhan = DB::select($keluhan_raw);
        }

        return DataTables::of($keluhan)
            ->addIndexColumn()
            ->addColumn('created_at', function ($keluhan) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $keluhan->created_at)->format('d-m-Y');
                return $formatDate;
            })
            ->addColumn('gambar', function ($keluhan) {
                $images = asset("storage/files/$keluhan->gambar");
                return '<img src="' . $images . '" style="height: 100px; width: 150px;"/>';
            })

            ->addColumn('action', function ($keluhan) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $keluhan->id . '"><i class="ph-eye"></i></a>';
            })

            ->rawColumns(['action', 'gambar'])
            ->make(true);
    }

    public function show($id)
    {
        $show = Keluhan::with(['user', 'jenis_keluhan', 'olt'])->find($id);
        if ($show) {
            return response()->json([
                'status' => 200,
                'show' => $show
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Keluhan tidak ditemukan',
            ]);
        }
    }
}
