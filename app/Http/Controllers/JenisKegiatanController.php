<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class JenisKegiatanController extends Controller
{
    //
    public function home(){
        return view('kegiatan.index');
    }

    public function store(Request $request)
    {
        $rule = [
            'jenis_kegiatan' => 'required'
        ];

        $message = [
            'jenis_kegiatan.required' => 'Tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Kegiatan();
            $ajax->jenis_kegiatan = $request->input('jenis_kegiatan');
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
        $activity = Kegiatan::find($id);
        if ($activity) {
            return response()->json([
                'status' => 200,
                'activity' => $activity,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Activity not found',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $activity = Kegiatan::find($id);
            $activity->jenis_kegiatan = $request->input('edit_jenis_kegiatan');

            $activity->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function activity()
    {
        $kegiatan = Kegiatan::orderBy('id','ASC')->get();
        
        return DataTables::of($kegiatan)
            ->addIndexColumn()
            
            ->addColumn('action', function ($kegiatan) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $kegiatan->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $kegiatan->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action','images'])
            ->make(true);
    }

    public function destroy($id)
    {
        $activity = Kegiatan::find($id);
        $activity->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
