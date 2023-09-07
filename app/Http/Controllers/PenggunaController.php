<?php

namespace App\Http\Controllers;

use App\Models\Pivotmarketer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller
{
    //

    public function index(){
        $data['role'] = Role::all();
        return view('pengguna.index', $data);
    }

     public function fetch()
    {
        $user = User::role('admin')->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $user->id . '"><i class="ph-pencil-simple"></i></a>
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $user->id . '"><i class="ph-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        
        $rule = [
            'nama' => 'required',
            'email' => 'required',
            'hp' => 'required',
            'role' => 'required'
        ];

        $message = [
            'nama.required' => 'Tidak Boleh Kosong',
            'email.required' => 'Tidak Boleh Kosong',
            'hp.required' => 'Tidak Boleh Kosong',
            'role.required' => 'Tidak Boleh Kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {


            $ajax = new User();
            $password = implode('@', explode('@', $request->input('email'), -1));
            $ajax->name = $request->input('nama');
            $ajax->email = $request->input('email');
            $ajax->handphone = $request->input('hp');
            $ajax->password = bcrypt($password);
            $ajax->assignRole($request->input('role')); // hardcode assign role
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $users = User::find($id);
        if ($users) {
            return response()->json([
                'status' => 200,
                'users' => $users,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Users not found',
            ]);
        }
    }

     public function update(Request $request, $id)
    {
        //
         $rule = [
            'nama' => 'required',
            'email' => 'required',
            'hp' => 'required',
        ];

        $message = [
            'nama.required' => 'Tidak Boleh Kosong',
            'email.required' => 'Tidak Boleh Kosong',
            'hp.required' => 'Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            if ($request->input('password') == '') {
                $user = User::find($id);
                $user->name = $request->input('edit_nama');
                $user->email = $request->input('edit_email');
                $user->handphone = $request->input('edit_handphone');

                $user->givePermissionTo('gm read');
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            } else {
                $user = User::find($id);
                $user->name = $request->input('edit_nama');
                $user->email = $request->input('edit_email');
                $user->handphone = $request->input('edit_handphone');
                $user->role = $request->input('edit_role');
                $user->jenis_pengguna = $request->input('edit_jenis_pengguna');
                $user->nama_perusahaan = $request->input('edit_nama_perusahaan');
                $user->nama_upline = $request->input('edit_nama_upline');
                $user->password = bcrypt($request->input('edit_password'));
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            }
        }
    }

    public function destroy(String $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil dihapus',
        ]);
    }


}
