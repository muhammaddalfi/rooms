<?php

namespace App\Http\Controllers;

use App\Models\Daily;
use App\Models\Kegiatan;
use App\Models\Olt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image as Image;

class KegiatanController extends Controller
{
    public function home()
    {
        $data['kegiatan'] = Kegiatan::orderBy('id', 'ASC')->get();
        $data['olt'] = Olt::all();
        return view('rooms.index', $data);
    }

    public function reload_olt(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lng;

        $olts = Olt::select(
            "olts.id",
            "olts.nama_olt",
            DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                        * cos(radians(olts.lat)) 
                        * cos(radians(olts.lng) - radians(" . $lon . ")) 
                        + sin(radians(" . $lat . ")) 
                        * sin(radians(olts.lat))) AS distance")
        )->orderBy("distance", "ASC")
            ->having('distance', '<', 1.0) //radius
            ->get();

        return $olts;
    }

    public function daily()
    {


        if (auth()->user()->can('admin read')) {
            $daily = Daily::with(['user', 'jenis_kegiatan']);
        }
        if (auth()->user()->can('user read')) {
            $daily = Daily::with(['user', 'jenis_kegiatan'])
                ->where('user_id', Auth()->user()->id)
                ->orderBy('id', 'desc')->get();
        }

        return DataTables::of($daily)
            ->addIndexColumn()
            ->addColumn('created_at', function ($daily) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $daily->created_at)->format('d-m-Y');
                return $formatDate;
            })
            ->addColumn('gambar', function ($daily) {
                $images = asset("storage/files/$daily->gambar");
                return '<img src="' . $images . '" style="height: 100px; width: 150px;"/>';
            })

            ->addColumn('action', function ($daily) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 view" data-id="' . $daily->id . '"><i class="ph-eye"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $daily->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $daily->id . '"><i class="ph-trash"></i></a>';
            })

            ->rawColumns(['action', 'gambar'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rule = [
            'latNow' => 'required',
            'lngNow' => 'required',
            'kategori' => 'required',
            'olt' => 'required',
            'kegiatan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ];

        $message = [
            'latNow.required' => 'This field is required',
            'lngNow.required' => 'This field is required',
            'olt.required' => 'This field is required',
            'kategori.required' => 'This field is required',
            'kegiatan.required' => 'This field is required',
            'gambar.required' => 'This field is required',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $path = 'files/';
            $gambar = $request->file('gambar');

            $format_name_images = time() . '.' . $gambar->extension();
            // $resize = Image::make($gambar);
            // $resize->fit(600)->save($gambar);

            $gambar->storeAs($path, $format_name_images, 'public');

            // Image::make($gambar)->resize(150,150)->save(storage_path('app/' .$format_name_images));


            $ajax = new Daily();
            $ajax->user_id = auth()->user()->id;
            $ajax->lat = $request->input('latNow');
            $ajax->lng = $request->input('lngNow');
            $ajax->kategori_dinas = $request->input('kategori');
            $ajax->nama_olt = $request->input('olt');
            $ajax->kegiatan_id = $request->input('kegiatan');
            $ajax->catatan = $request->input('catatan');
            $ajax->gambar = $format_name_images;
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data saved successfully',
            ]);
        }
    }

    public function show($id)

    {
        // $daily = Daily::all();
        $daily = Daily::with(['user', 'jenis_kegiatan'])->first();

        if ($daily) {
            return response()->json([
                'status' => 200,
                'daily' => $daily
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Daily not found',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $daily = Daily::find($id);
        if ($daily) {
            return response()->json([
                'status' => 200,
                'daily' => $daily,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Dailys not found',
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $rule = [
            'edit_kategori' => 'required',
            'edit_olt' => 'required',
            'edit_kegiatan' => 'required'
        ];

        $message = [
            'edit_kategori.required' => 'This field is required',
            'edit_olt.required' => 'This field is required',
            'edit_kegiatan.required' => 'This field is required'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = Daily::find($id);

            if ($ajax) {

                $ajax->kategori_dinas = $request->input('edit_kategori');
                $ajax->nama_olt = $request->input('edit_olt');
                $ajax->kegiatan_id = $request->input('edit_kegiatan');
                $ajax->catatan = $request->input('edit_catatan');

                if ($request->hasFile('edit_gambar')) {
                    $path = 'images/' . $ajax->gambar;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $edit_gambar = $request->file('edit_gambar');
                    $format_name_edit_gambar = time() . '.' . $edit_gambar->extension();
                    $edit_gambar->move('images/', $format_name_edit_gambar);
                    $ajax->gambar = $format_name_edit_gambar;
                }

                $ajax->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updates successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data not found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $daily = Daily::find($id);
        $deletedFile  = File::delete("images/" . $daily->gambar);
        if (File::exists($deletedFile)) {
            File::delete($deletedFile);
        }
        $daily->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
