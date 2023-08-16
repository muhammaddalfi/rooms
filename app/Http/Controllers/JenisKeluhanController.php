<?php

namespace App\Http\Controllers;

use App\Models\Jenis_keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JenisKeluhanController extends Controller
{
     public function home(){
        return view('jenis_keluhan.index');
    }

    public function store(Request $request)
    {
        $rule = [
            'jenis_keluhan' => 'required'
        ];

        $message = [
            'jenis_keluhan.required' => 'Tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Jenis_keluhan();
            $ajax->jenis_keluhan = $request->input('jenis_keluhan');
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil disimpan',
            ]);
        }
    }

     public function edit($id)
    {
        //
        $jenis_keluhan = Jenis_keluhan::find($id);
        if ($jenis_keluhan) {
            return response()->json([
                'status' => 200,
                'jenis_keluhan' => $jenis_keluhan,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Jenis Keluhan tidak ditemukan',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $jenis_keluhan = Jenis_keluhan::find($id);
            $jenis_keluhan->jenis_keluhan = $request->input('edit_jenis_keluhan');

            $jenis_keluhan->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function jenis_keluhan()
    {
        $jenis_keluhan = Jenis_keluhan::orderBy('id','ASC')->get();
        
        return DataTables::of($jenis_keluhan)
            ->addIndexColumn()
            
            ->addColumn('action', function ($jenis_keluhan) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $jenis_keluhan->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $jenis_keluhan->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        $jenis_keluhan = Jenis_keluhan::find($id);
        $jenis_keluhan->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
