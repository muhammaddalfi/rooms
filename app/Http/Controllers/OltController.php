<?php

namespace App\Http\Controllers;

use App\Imports\OltsImport;
use App\Models\Olt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Termwind\Components\Ol;
use Yajra\DataTables\DataTables;

class OltController extends Controller
{
    //
        //
    public function home(){
        $data['pic'] = User::all();
        return view('olt.index',$data);
    }

    public function store(Request $request)
    {
        $rule = [
            'nama_olt' => 'required',
            'lat' => 'required',
            'lat' => 'required',
            'pic' => 'required'
        ];

        $message = [
            'nama_olt.required' => 'Tidak Boleh Kosong',
            'lat.required' => 'Tidak Boleh Kosong',
            'lng.required' => 'Tidak Boleh Kosong',
            'pic.required' => 'Tidak Boleh Kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Olt();
            $ajax->nama_olt = $request->input('nama_olt');
            $ajax->lat = $request->input('lat');
            $ajax->lng = $request->input('lng');
            $ajax->user_id = $request->input('pic');
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil Ditambahkan',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $olt = Olt::find($id);
        if ($olt) {
            return response()->json([
                'status' => 200,
                'olt' => $olt,
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
            $activity = Olt::find($id);
            $activity->nama_olt = $request->input('edit_nama_olt');
            $activity->lat = $request->input('edit_lat');
            $activity->lng = $request->input('edit_lng');
            $activity->user_id = $request->input('edit_pic');

            $activity->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function olt()
    {
        // $olt = Olt::all();
        if(auth()->user()->can('admin read')){
            $olt_raw = "SELECT o.id,o.nama_olt,o.lat, o.lng, u.name
                        FROM olts o
                        LEFT JOIN users u ON u.id = o.user_id";
            $olt = DB::select($olt_raw); 
        }
        if(auth()->user()->can('leader read')){
            // $olt_raw = "SELECT o.nama_olt,o.lat, o.lng, u.name
            //             FROM olts o
            //             LEFT JOIN users u ON u.id = o.user_id
            //             WHERE o.user_id IN (SELECT id FROM users where id_leader = '".auth()->user()->id."')";
            $olt_raw = "SELECT o.nama_olt,o.lat, o.lng, u.name
                        FROM olts o
                        LEFT JOIN users u ON u.id = o.user_id";
            $olt = DB::select($olt_raw); 
        }
        if(auth()->user()->can('user read')){
            $olt_raw = "SELECT o.nama_olt,o.lat, o.lng, u.name
                        FROM olts o
                        LEFT JOIN users u ON u.id = o.user_id
                        WHERE o.user_id = '".auth()->user()->id."'";
            $olt = DB::select($olt_raw); 
        }
        return DataTables::of($olt)
            ->addIndexColumn()
            ->addColumn('koordinat', function($olt){
                return $olt->lat .','. $olt->lng;
            })
            ->addColumn('action', function ($olt) {
                if(auth()->user()->can('admin read')){
                       return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $olt->id . '"><i class="ph-pencil-simple"></i></a>';
                }

                if(auth()->user()->can('leader read')){
                       return '<a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 map" data-id="' . $olt->lat .','. $olt->lng. '"><i class="ph-map-trifold"></i></a>';
                }
                if(auth()->user()->can('user read')){
                       return '<a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 map" data-id="' . $olt->lat .','. $olt->lng. '"><i class="ph-map-trifold"></i></a>';
                }
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        $olt = Olt::find($id);
        $olt->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }

    public function import()
    {
        Excel::import(new OltsImport, request()->file('file'));
        return back();
    }
}

//test