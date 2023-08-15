<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UplineController extends Controller
{
    //
    public function index(){
        $data['leader'] = User::where('jenis_pengguna','leader_internal')->get();
        return view('upline.index',$data);
    }

    public function fetch()
    {
        $user = User::where('jenis_pengguna','leader_internal')->get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('anggota', function ($user) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-success btn-icon ml-2 anggota" data-id="' . $user->id . '"><i class="ph-user-plus"></i></a>';
            })
            ->addColumn('action', function ($user) {
                return '
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-icon ml-2 edit_leader" data-id="' . $user->id . '"><i class="ph-note-pencil"></i></a> 
                <a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 delete" data-id="' . $user->id . '"><i class="ph-trash"></i></a>';
            })
            ->rawColumns(['action','anggota'])
            ->make(true);
    }
        public function edit($id)
    {
        $leader = User::find($id);
        if ($leader) {
            return response()->json([
                'status' => 200,
                'leader' => $leader,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'leader tidak ditemukan',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        //
        $rule = [
            'edit_nama_leader' => 'required',
            'edit_email_leader' => 'required',
            'edit_handphone_leader' => 'required',
        ];

        $message = [
            'edit_nama_leader.required' => 'Tidak Boleh Kosong',
            'edit_email_leader.required' => 'Tidak Boleh Kosong',
            'edit_handphone_leader.required' => 'Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            if ($request->input('edit_password_leader') == '') {
                $user = User::find($id);
                $user->name = $request->input('edit_nama_leader');
                $user->email = $request->input('edit_email_leader');
                $user->handphone = $request->input('edit_handphone_leader');
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                ]);
            } else {
                $user = User::find($id);
                $user->name = $request->input('edit_nama_leader');
                $user->email = $request->input('edit_email_leader');
                $user->handphone = $request->input('edit_handphone_leader');
                $user->password = bcrypt($request->input('edit_password_leader'));
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
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

    public function store(Request $request)
    {
        //
        $rule = [
            'nama_leader' => 'required',
            'email_leader' => 'required',
            'handphone_leader' => 'required'
        ];

        $message = [
            'nama_leader.required' => 'Tidak Boleh Kosong',
            'email_leader.required' => 'Tidak Boleh Kosong',
            'handphone_leader.required' => 'Tidak Boleh Kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {


            $ajax = new User();
            $password = implode('@', explode('@', $request->input('email_leader'), -1));
            $ajax->name = $request->input('nama_leader');
            $ajax->email = $request->input('email_leader');
            $ajax->jenis_pengguna = 'leader_internal';
            $ajax->handphone = $request->input('handphone_leader');
            $ajax->password = bcrypt($password);

            $ajax->save();
            $ajax->assignRole('user'); // hardcode assign role
            return response()->json([
                'status' => 200,
                'message' => 'Data tersimpan',
            ]);
        }
    }

    public function show_anggota()
    {
        $anggota = User::where('jenis_pengguna','anggota_internal')->get();
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
            'nama_anggota_leader' => 'required',
            'email_anggota_leader' => 'required',
            'hp_anggota_leader' => 'required',
        ];

        $message = [
            'nama_anggota_leader.required' => 'Tidak Boleh Kosong',
            'email_anggota_leader.required' => 'Tidak Boleh Kosong',
            'hp_anggota_leader.required' => 'Tidak Boleh Kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {


            $ajax = new User();
            $password = implode('@', explode('@', $request->input('email_anggota_leader'), -1));
            $ajax->id_leader = $request->input('id_pic');
            $ajax->leader = $request->input('nama_pic');
            $ajax->name = $request->input('nama_anggota_leader');
            $ajax->email = $request->input('email_anggota_leader');
            $ajax->handphone = $request->input('hp_anggota_leader');
            $ajax->jenis_pengguna = 'anggota_internal';
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
        $anggota_leader = User::find($id);
        if ($anggota_leader) {
            return response()->json([
                'status' => 200,
                'anggota_leader' => $anggota_leader,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Anggota leader tidak ditemukan',
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
            'edit_leader' => 'required',
        ];

        $message = [
            'edit_nama_anggota.required' => 'Tidak Boleh Kosong',
            'edit_email_anggota.required' => 'Tidak Boleh Kosong',
            'edit_handphone.required' => 'Tidak Boleh Kosong',
            'edit_leader.required' => 'Tidak Boleh Kosong',
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
                $user->id_leader = $request->input('edit_leader');
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
                $user->id_leader = $request->input('edit_leader');
                $user->password = bcrypt($request->input('edit_password_anggota'));
                $user->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated successfully',
                ]);
            }
        }
    }

    public function show_leader($id)
    {
        //
        $show_leader = User::find($id);
        if ($show_leader) {
            return response()->json([
                'status' => 200,
                'show_leader' => $show_leader,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Leader tidak ditemukan',
            ]);
        }
    }



}
