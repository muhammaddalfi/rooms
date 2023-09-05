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
        $data['perusahaan'] = User::where('jenis_pengguna','leader_perusahaan')->get();
        return view('mpp.index',$data);
    }

    public function fetch()
    {
        $user = User::where('jenis_pengguna','leader_perusahaan')->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('anggota', function ($user) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 anggota" data-id="' . $user->id . '"><i class="ph-user-plus"></i></a>';
            })
            ->addColumn('action', function ($user) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit" data-id="' . $user->id . '"><i class="ph-note-pencil"></i></a> 
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $user->id . '"><i class="ph-trash"></i></a>';
            })
            ->rawColumns(['action','anggota'])
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
            $ajax->jenis_pengguna = 'leader_perusahaan';
            $ajax->password = bcrypt($password);

            $ajax->save();
            $ajax->assignRole('leader'); // hardcode assign role
            $user = User::where('id',$ajax->id);
            $user->update(['id_leader' => $ajax->id]);
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
        }
    }


    public function show_anggota()
    {
        $anggota = User::where('jenis_pengguna','anggota_perusahaan')->get();
        return DataTables::of($anggota)
            ->addIndexColumn()
            ->addColumn('action', function ($anggota) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit_anggota" data-id="' . $anggota->id . '"><i class="ph-note-pencil"></i></a> 
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $anggota->id . '"><i class="ph-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store_anggota(Request $request)
    {
        //
        $rule = [
            'nama_anggota_perusahaan' => 'required',
            'email_anggota_perusahaan' => 'required',
            'hp_anggota_perusahaan' => 'required',
        ];

        $message = [
            'nama_anggota_perusahaan.required' => 'Tidak Boleh Kosong',
            'email_anggota_perusahaan.required' => 'Tidak Boleh Kosong',
            'hp_anggota_perusahaan.required' => 'Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {


            $ajax = new User();
            $password = implode('@', explode('@', $request->input('email_anggota_perusahaan'), -1));
            $ajax->id_leader = $request->input('id_perusahaan');
            $ajax->leader = $request->input('nama_perusahaan');
            $ajax->name = $request->input('nama_anggota_perusahaan');
            $ajax->email = $request->input('email_anggota_perusahaan');
            $ajax->handphone = $request->input('hp_anggota_perusahaan');
            $ajax->jenis_pengguna = 'anggota_perusahaan';
            $ajax->password = bcrypt($password);

            $ajax->save();
            $ajax->assignRole('user'); // hardcode assign role
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
        }
    }

    public function edit_anggota($id)
    {
        //
        $anggota_perusahaan = User::find($id);
        if ($anggota_perusahaan) {
            return response()->json([
                'status' => 200,
                'anggota_perusahaan' => $anggota_perusahaan,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Anggota perusahaan tidak ditemukan',
            ]);
        }
    }

    public function update_anggota(Request $request, $id)
    {
        //
        $rule = [
            'edit_nama_anggota' => 'required',
            'edit_email_anggota' => 'required',
            'edit_handphone_anggota' => 'required',
            'edit_perusahaan' => 'required',
        ];

        $message = [
            'edit_nama_anggota.required' => 'Tidak Boleh Kosong',
            'edit_email_anggota.required' => 'Tidak Boleh Kosong',
            'edit_handphone.required' => 'Tidak Boleh Kosong',
            'edit_perusahaan.required' => 'Tidak Boleh Kosong',
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
                $user->name = $request->input('edit_nama_anggota');
                $user->email = $request->input('edit_email_anggota');
                $user->handphone = $request->input('edit_handphone_anggota');
                $user->id_leader = $request->input('edit_perusahaan');
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            } else {
                $user = User::find($id);
                $user->name = $request->input('edit_nama_anggota');
                $user->email = $request->input('edit_email_anggota');
                $user->handphone = $request->input('edit_handphone_anggota');
                $user->id_leader = $request->input('edit_perusahaan');
                $user->password = bcrypt($request->input('edit_password_anggota'));
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            }
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
