<?php

namespace App\Http\Controllers;

use App\Models\Radiusmap;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class RadiusController extends Controller
{
    public function index()
    {
        return view('radius.index');
    }

    public function fetch()
    {
        // if (auth()->user()->can('admin read')) {
        //     $daily = Daily::with(['user', 'olt', 'jenis_kegiatan']);
        // }
        // if (auth()->user()->can('user read')) {
        //     $daily = Daily::with(['user', 'olt', 'jenis_kegiatan'])
        //         ->where('user_id', Auth()->user()->id)
        //         ->orderBy('id', 'desc')->get();
        // }
        $radius = Radiusmap::all();
        return DataTables::of($radius)
            ->addIndexColumn()
            ->addColumn('action', function ($radius) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $radius->id . '"><i class="ph-pencil-simple"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rule = [
            'nama_setting' => 'required',
            'value_setting' => 'required',
            'kode_setting' => 'required'
        ];

        $message = [
            'nama_setting.required' => 'This field is required',
            'value_setting.required' => 'This field is required',
            'kode_setting.required' => 'This field is required'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Radiusmap();
            $ajax->nama_setting = $request->input('nama_setting');
            $ajax->value_setting = $request->input('value_setting');
            $ajax->kode_setting = $request->input('kode_setting');
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data saved successfully',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $radius = Radiusmap::find($id);
        if ($radius) {
            return response()->json([
                'status' => 200,
                'radius' => $radius,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Olt not found',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $activity = Radiusmap::find($id);
            $activity->nama_setting = $request->input('edit_nama_setting');
            $activity->value_setting = $request->input('edit_value_setting');
            $activity->kode_setting = $request->input('edit_kode_setting');

            $activity->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }
}
