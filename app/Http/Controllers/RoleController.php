<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    //
    public function index(){
        $data['permission'] = Permission::all();
        return view('role.index',$data);
    }


    public function create()
    {
        $data['permission'] = Permission::orderBy('name', 'ASC')->get();
        return view('role.create',$data);
    }


    public function fetch()
    {
        $role = Role::all();
        return DataTables::of($role)
            ->addIndexColumn()
            ->addColumn('permission', function ($role) {
                    return $role->getPermissionNames()->map(function ($per) {
                        return '<button class="btn btn-sm btn-success mb-1 mt-1 mr-1">' . $per . '</button>';
                    })->implode(' ');
                })
            ->addColumn('action', function ($role) {
                return '<a href="'. url('/role',$role->id).'" class="btn btn-outline-primary btn-icon ml-2" data-id="' . $role->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $role->id . '"><i class="ph-trash"></i></a>';
            })
            
            ->rawColumns(['action','permission'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rule = [
            'role' => 'required',
        ];

        $message = [
            'role.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $role = Role::create(['name' => $request->input('role')]);
            $role->syncPermissions($request->input('akses'));

            return response()->json([
                'status' => 200,
                'message' => 'Data berhasil disimpan',
            ]);
        }
    }

     public function edit($id)
    {
        //
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::all();
        return view('role.edit',$data);
        // if ($role) {
        //     return response()->json([
        //         'status' => 200,
        //         'role' => $role,
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'message' => 'Role tidak ditemukan',
        //     ]);
        // }
    }
    public function update(Request $request, string $id)
    {
            $name = Role::find($id);
            $name->name = $request->input('role');
            $name->syncPermissions($request->input('permissions'));

            $name->update();
            // return redirect('/role')->with('success','Data Berhasi disimpan');
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
