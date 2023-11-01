<?php

namespace App\Http\Controllers;

use App\Models\Baddeb;
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BadDebController extends Controller
{
    //
    public function index()
    {
        $data['kategori'] = Debt::all();
        return view('baddeb.index',$data);
    }

    public function store(Request $request)
    {
        $rule = [
            'nama' => 'required',
            'id_pln' => 'required',
            'telp' => 'required',
            'select_layanan' => 'required',
            'tagihan' => 'required',
            'alamat' => 'required'
        ];

        $message = [
            'nama.required' => 'Tidak boleh kosong',
            'id_pln.required' => 'Tidak boleh kosong',
            'telp.required' => 'Tidak boleh kosong',
            'select_layanan.required' => 'Tidak boleh kosong',
            'tagihan.required' => 'Tidak boleh kosong',
            'alamat.required' => 'Tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Baddeb();
            $ajax->nama_pelanggan = $request->input('nama');
            $ajax->id_pln = $request->input('id_pln');
            $ajax->telp = $request->input('telp');
            $ajax->nik = $request->input('nik');
            $ajax->layanan = $request->input('select_layanan');
            $ajax->tagihan = $request->input('tagihan');
            $ajax->alamat = $request->input('alamat');
            $ajax->user_id = auth()->user()->id;
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
        $pelanggan_baddeb = Baddeb::find($id);
        if ($pelanggan_baddeb) {
            return response()->json([
                'status' => 200,
                'pelanggan_baddeb' => $pelanggan_baddeb,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function update(Request $request, string $id_pelanggan)
    {
        $ajax = Baddeb::find($id_pelanggan);

            if($ajax) {
               
                if ($request->input('is_minat') == 'ya' ){
                    $ajax->is_minat = $request->input('is_minat');
                    $ajax->follow_up = $request->input('follow_up_ya');
                    $ajax->waktu_bayar = Carbon::parse($request->input('tgl_bayar_ya'));
                    $ajax->kategori_debt = $request->input('kategori_debt_ya');
                    $ajax->issue_bayar = $request->input('issue_bayar_ya');
                    $ajax->keterangan = $request->input('keterangan_ya');
                    $ajax->status_bayar = 'pending';
                }

                if ($request->input('is_minat') == 'bayar' ){
                    $ajax->is_minat = 'ya';
                    $ajax->follow_up = $request->input('follow_up_bayar');
                    $ajax->waktu_bayar = Carbon::parse($request->input('tgl_bayar_bayar'));

                    $path = 'files/';
                    $gambar_1 = $request->file('gambar_1');
                    $format_name_gambar_1 = time() .'gambar1'. '.' . $gambar_1->extension();
                    $gambar_1->storeAs($path, $format_name_gambar_1, 'public');
                    $ajax->gambar_bayar_pelanggan = $format_name_gambar_1;

                    $gambar_2 = $request->file('gambar_2');
                    $format_name_gambar_2 = time() . 'gambar2'. '.' . $gambar_2->extension();
                    $gambar_2->storeAs($path, $format_name_gambar_2, 'public');
                    $ajax->gambar_bayar_icrm = $format_name_gambar_2;

                    $ajax->kategori_debt = $request->input('kategori_debt_bayar');
                    $ajax->issue_bayar = $request->input('issue_bayar_bayar');
                    $ajax->status_bayar = 'close';
                    $ajax->myicon = $request->input('my_icon');
                }

                if ($request->input('is_minat') == 'tidak' ){
                    $ajax->is_minat = 'tidak';
                    $ajax->kategori_debt = $request->input('kategori_debt_tidak');
                    $ajax->follow_up = $request->input('follow_up_tidak');
                    $ajax->status_bayar = 'lose';
                }



                $ajax->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil disimpan',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
    }

    public function fetch()
    {
        if(Auth::user()->hasRole(['admin','management'])){
             $baddebt = Baddeb::whereNotIn('status_bayar', ['close','lose'])->get();
        }else if(Auth::user()->hasRole(['sales'])){
                $baddebt = Baddeb::where('user_id', auth()->user()->id)
            ->whereNotIn('status_bayar', ['close','lose'])->get();
        }
        // $baddebt = Baddeb::all();
        
        // dd($baddebt);
        return DataTables::of($baddebt)
            ->addIndexColumn()
            ->addColumn('updated_at', function ($baddebt) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $baddebt->updated_at)->format('d-m-Y H:i');
                return $formatDate;
            })
            ->addColumn('action', function ($baddebt) {
            if(auth()->user()->can('piutang edit')){
                 return '<a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 fu" data-id="' . $baddebt->id . '"><i class="ph-phone-outgoing"></i></a>';
            }else{
                return '';
            }
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
}
