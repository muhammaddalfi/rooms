<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    //
    public function index(){
        return view('role.index');
    }

    public function fetch()
    {
        $role = Role::all();
        
        return DataTables::of($role)
            ->addIndexColumn()
            
            ->addColumn('action', function ($role) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $role->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $role->id . '"><i class="ph-trash"></i></a>';
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

            $ajax = new Role();
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
        $role = Role::find($id);
        if ($role) {
            return response()->json([
                'status' => 200,
                'role' => $role,
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
            $name = Role::find($id);
            $name->name = $request->input('edit_name');

            $name->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
