<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class KategoriDebt extends Controller
{
    //
    public function index()
    {
        return view('katdeb.index');
    }

    public function fetch()
    {
        $katdeb = Debt::all();
        
        return DataTables::of($katdeb)
            ->addIndexColumn()
            ->addColumn('action', function ($katdeb) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $katdeb->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $katdeb->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rule = [
            'name' => 'required'
        ];

        $message = [
            'name.required' => 'Tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Debt();
            $ajax->name = $request->input('name');
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
        $katdeb = Debt::find($id);
        if ($katdeb) {
            return response()->json([
                'status' => 200,
                'katdeb' => $katdeb,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Role tidak ditemukan',
            ]);
        }
    }
    public function update(Request $request, string $id)
    {
            $name = Debt::find($id);
            $name->name = $request->input('edit_name');

            $name->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function destroy($id)
    {
        $katdeb = Debt::find($id);
        $katdeb->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
