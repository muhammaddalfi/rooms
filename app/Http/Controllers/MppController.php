<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MppController extends Controller
{
    //

     public function index(){
        return view('mpp.index');
    }

     public function fetch()
    {
        $user = User::where('jenis_pengguna','mpp')->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $user->id . '"><i class="ph-note-pencil"></i></a> 
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $user->id . '"><i class="ph-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
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


            $ajax = new User();
            $password = implode('@', explode('@', $request->input('email'), -1));
            $ajax->name = $request->input('nama');
            $ajax->email = $request->input('email');
            $ajax->handphone = $request->input('hp');
            $ajax->nama_perusahaan = $request->input('nama');
            $ajax->jenis_pengguna = 'mpp';
            $ajax->password = bcrypt($password);

            $ajax->save();
            $ajax->assignRole('user'); // hardcode assign role
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
        }
    }

    public function edit($id)
    {
        //
        $mpp = User::find($id);
        if ($mpp) {
            return response()->json([
                'status' => 200,
                'mpp' => $mpp,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'MPP Users not found',
            ]);
        }
    }

     public function update(Request $request, $id)
    {
        //
        $rule = [
            'edit_nama' => 'required',
            'edit_email' => 'required',
            'edit_handphone' => 'required',
        ];

        $message = [
            'edit_nama.required' => 'Tidak Boleh Kosong',
            'edit_email.required' => 'Tidak Boleh Kosong',
            'edit_handphone.required' => 'Tidak Boleh Kosong',
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
