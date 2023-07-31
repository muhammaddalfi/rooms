<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PenggunaController extends Controller
{
    //

    public function index(){
        $data['upline'] = User::where('jenis_pengguna','upline')->get();
        $data['mpp'] = User::where('jenis_pengguna','mpp')->get();
        return view('pengguna.index',$data);
    }

     public function fetch()
    {
        $user = User::where('jenis_pengguna','mpi')
        ->orwhere('jenis_pengguna','mpp')
        ->get();
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
            'jenis_pengguna' => 'required',
            'role' => 'required',
        ];

        $message = [
            'nama.required' => 'Tidak Boleh Kosong',
            'email.required' => 'Tidak Boleh Kosong',
            'hp.required' => 'Tidak Boleh Kosong',
            'jenis_pengguna.required' => 'Tidak Boleh Kosong',
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
            $ajax->nama_perusahaan = $request->input('nama_perusahaan');
            $ajax->nama_upline = $request->input('nama_upline');
            $ajax->jenis_pengguna = $request->input('jenis_pengguna');
            $ajax->password = bcrypt($password);

            $ajax->save();
            $ajax->assignRole($request->input('role')); // hardcode assign role
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
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
