<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    //
    public function index(){
        return view('permission.index');
    }

    public function fetch()
    {
        $permission = Permission::all();
        
        return DataTables::of($permission)
            ->addIndexColumn()
            ->addColumn('action', function ($permission) {
                return '<a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $permission->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $permission->id . '"><i class="ph-trash"></i></a>';
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

            $ajax = new Permission();
            $ajax->name = $request->input('name');
            $ajax->guard_name ='web';
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
        $permission = Permission::find($id);
        if ($permission) {
            return response()->json([
                'status' => 200,
                'permission' => $permission,
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
            $name = Permission::find($id);
            $name->name = $request->input('edit_name');

            $name->update();
            return response()->json([
                'status' => 200,
                'message' => 'Data has been changed!',
            ]);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data has been remove'
        ]);
    }
}
