<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Ol;
use Yajra\DataTables\DataTables;

class OltController extends Controller
{
    //
        //
    public function home(){
        return view('olt.index');
    }

    public function store(Request $request)
    {
        $rule = [
            'nama_olt' => 'required',
            'prioritas' => 'required',
        ];

        $message = [
            'nama_olt.required' => 'This field is required',
            'prioritas.required' => 'This field is required'
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
            $ajax->prioritas = $request->input('prioritas');
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
            $activity->prioritas = $request->input('edit_prioritas');

            $activity->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function olt()
    {
        $olt = Olt::all();
        
        return DataTables::of($olt)
            ->addIndexColumn()
            
            ->addColumn('action', function ($olt) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $olt->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $olt->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action','images'])
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
}
