<?php

namespace App\Http\Controllers;

use App\Models\Olt;
use App\Models\Pm;
use App\Models\Radiusmap;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PMController extends Controller
{
    //
    public function index()
    {
        $data['cluster'] = Olt::all();
        return view('pm.index',$data);
    }

    public function store(Request $request)
    {
        $rule = [
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'lokasi' => 'required',
        ];

        $message = [
            'tgl_mulai.required' => 'Tidak boleh kosong',
            'tgl_selesai.required' => 'Tidak boleh kosong',
            'lokasi.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

            $ajax = new Pm();
            $ajax->user_id = auth()->user()->id;
            $ajax->id_lokasi = $request->input('lokasi');
            $ajax->tgl_mulai = Carbon::parse($request->input('tgl_mulai'));
            $ajax->tgl_selesai = Carbon::parse($request->input('tgl_selesai'));
            $ajax->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil Ditambahkan',
            ]);
        }
    }

    public function fetch()
    {
        // $pm = Pm::with(['user','olt'])->get();

        $query = "SELECT p.*, o.nama_olt as lokasi, u.name as petugas
                FROM pms p
                LEFT JOIN users u ON u.id = p.user_id
                LEFT JOIN olts o ON o.id = p.id_lokasi
                WHERE p.is_olt = '0' 
                OR p.is_feeder = '0' OR p.is_fdt = '0' OR p.is_fat = '0'";
        $pm = DB::select($query);
        return DataTables::of($pm)
            ->addIndexColumn()
            ->addColumn('tgl_mulai', function ($pm) {
                $formatDate = Carbon::createFromFormat('Y-m-d H:i:s', $pm->tgl_mulai)->format('d-m-Y');
                return $formatDate;
            })
            ->addColumn('olt', function ($pm) {
               if($pm->is_olt == 0){
                    return '<a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 tombol_olt" data-id="' . $pm->id . '">Belum</a>';
                }else if($pm->is_olt == 1){
                    return '<span class="badge bg-success">Selesai</span>';
                }
            })

            ->addColumn('feeder', function ($pm) {
               if($pm->is_feeder == 0){
                    return '<a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 feeder" data-id="' . $pm->id . '">Belum</a>';
                }else if($pm->is_feeder == 1){
                    return '<span class="badge bg-success">Selesai</span>';
                }
            })

            ->addColumn('fdt', function ($pm) {
               if($pm->is_fdt == 0){
                    return '<a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 fdt" data-id="' . $pm->id . '">Belum</a>';
                }else if($pm->is_fdt == 1){
                    return '<span class="badge bg-success">Selesai</span>';
                }
            })

            ->addColumn('fat', function ($pm) {
               if($pm->is_fat == 0){
                    return '<a href="javascript:void(0)" class="btn btn-outline-danger btn-icon ml-2 fat" data-id="' . $pm->id . '">Belum</a>';
                }else if($pm->is_fat == 1){
                    return '<span class="badge bg-success">Selesai</span>';
                }
            })
            
            ->rawColumns(['olt','feeder','fdt','fat'])
            ->make(true);
    }

    public function edit_olt($id)
    {
        $pm = Pm::find($id);
        if ($pm) {
            return response()->json([
                'status' => 200,
                'pm' => $pm,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function edit_feeder($id)
    {
        $pm_feeder = Pm::find($id);
        if ($pm_feeder) {
            return response()->json([
                'status' => 200,
                'pm_feeder' => $pm_feeder,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function edit_fdt($id)
    {
        $pm_fdt = Pm::find($id);
        if ($pm_fdt) {
            return response()->json([
                'status' => 200,
                'pm_fdt' => $pm_fdt,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function edit_fat($id)
    {
        $pm_fat = Pm::find($id);
        if ($pm_fat) {
            return response()->json([
                'status' => 200,
                'pm_fat' => $pm_fat,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    public function olt(Request $request, string $id_pm)
    {
         $rule = [
            'olt' => 'required',
            'kondisi_modul_olt' => 'required',
            'kondisi_port_olt' => 'required',
            'kondisi_sfp_olt' => 'required',
            'kondisi_power_supply' => 'required',
            'kondisi_battery' => 'required',
            'battery_backup' => 'required',
            'kondisi_suhu_kabinet' => 'required',
            'dokumentasi_olt' => 'required|image|mimes:jpeg,png,jpg|max:5048'
        ];

        $message = [
            'olt.required' => 'Tidak boleh kosong',
            'kondisi_modul_olt.required' => 'Tidak boleh kosong',
            'kondisi_port_olt.required' => 'Tidak boleh kosong',
            'kondisi_sfp_olt.required' => 'Tidak boleh kosong',
            'kondisi_power_supply.required' => 'Tidak boleh kosong',
            'kondisi_battery.required' => 'Tidak boleh kosong',
            'battery_backup.required' => 'Tidak boleh kosong',
            'kondisi_suhu_kabinet.required' => 'Tidak boleh kosong',
            'dokumentasi_olt.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

         $ajax = Pm::find($id_pm);
            if($ajax) {
                $path = 'files/pm';
                $ajax->is_olt = 1;

                $ajax->id_lokasi = $request->input('olt');
                $ajax->kondisi_modul_olt = $request->input('kondisi_modul_olt');
                $ajax->catatan_modul_olt = $request->input('catatan_modul_olt');
                
                $ajax->kondisi_port_olt = $request->input('kondisi_port_olt');
                $ajax->catatan_port_olt = $request->input('catatan_port_olt');

                $ajax->kondisi_all_sfp_olt = $request->input('kondisi_sfp_olt');
                $ajax->catatan_all_sfp_olt = $request->input('catatan_kondisi_sfp');

                $ajax->kondisi_ps_olt = $request->input('kondisi_power_supply');
                $ajax->catatan_ps_olt = $request->input('catatan_kondisi_power_supply');

                $ajax->kondisi_bat_olt = $request->input('kondisi_battery');
                $ajax->catatan_bat_olt = $request->input('catatan_kondisi_battery');

                $ajax->kondisi_bat_bck_olt = $request->input('battery_backup');
                $ajax->catatan_bat_bck_olt = $request->input('catatan_battery_backup');

                $ajax->kondisi_suhu_kabinet = $request->input('kondisi_suhu_kabinet');
                $ajax->catatan_suhu_kabinet = $request->input('catatan_suhu_kabinet');
                
                $dokumentasi = $request->file('dokumentasi_olt');
                $format_name_dokumentasi = time() .'olt'. '.' . $dokumentasi->extension();
                $dokumentasi->storeAs($path, $format_name_dokumentasi, 'public');
                $ajax->dokumentasi_olt = $format_name_dokumentasi;

              

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
           
    }

    public function feeder(Request $request, string $id_pm)
    {
        $rule = [
            'kabel_jatuh' => 'required',
            'kabel_andongan' => 'required',
            'kabel_putus' => 'required',
            'kabel_bagus' => 'required',
            'accessoris' => 'required',
            'kondisi_accessoris' => 'required',
            'jb' => 'required',
            'kondisi_jb' => 'required',
            'core' => 'required',
            'posisi_jb' => 'required',
            'dokumentasi_feeder' => 'required',
        ];

        $message = [
            'kabel_jatuh.required' => 'Tidak boleh kosong',
            'kabel_andongan.required' => 'Tidak boleh kosong',
            'kabel_putus.required' => 'Tidak boleh kosong',
            'kabel_bagus.required' => 'Tidak boleh kosong',
            'accessoris.required' => 'Tidak boleh kosong',
            'kondisi_accessoris.required' => 'Tidak boleh kosong',
            'jb.required' => 'Tidak boleh kosong',
            'kondisi_jb.required' => 'Tidak boleh kosong',
            'core.required' => 'Tidak boleh kosong',
            'posisi_jb.required' => 'Tidak boleh kosong',
            'dokumentasi_feeder.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

         $ajax = Pm::find($id_pm);
            if($ajax) {
                $path = 'files/pm';
                $ajax->is_feeder = 1;
                $ajax->kabel_jatuh = $request->input('kabel_jatuh');
                $ajax->catatan_kabel_jatuh = $request->input('catatan_kabel_jatuh');
                
                $ajax->kabel_andongan = $request->input('kabel_andongan');
                $ajax->catatan_kabel_andongan = $request->input('catatan_kabel_andongan');

                $ajax->kabel_putus = $request->input('kabel_putus');
                $ajax->catatan_kabel_putus = $request->input('catatan_kabel_putus');

                $ajax->kondisi_kabel = $request->input('kabel_bagus');
                $ajax->catatan_kondisi_kabel = $request->input('catatan_kabel_bagus');

                $ajax->kabel_acc = $request->input('accessoris');
                $ajax->catatan_kabel_acc = $request->input('catatan_accessoris');

                $ajax->kondisi_acc = $request->input('kondisi_accessoris');
                $ajax->catatan_kondisi_acc = $request->input('catatan_kondisi_accessoris');

                $ajax->jb = $request->input('jb');
                $ajax->catatan_jb = $request->input('catatan_jb');

                $ajax->kondisi_jb = $request->input('kondisi_jb');
                $ajax->catatan_kondisi_jb = $request->input('catatan_kondisi_jb');

                $ajax->core_jb = $request->input('core');
                $ajax->catatan_core_jb = $request->input('catatan_core');

                $ajax->posisi_jb = $request->input('posisi_jb');
                $ajax->catatan_posisi_jb = $request->input('catatan_posisi_jb');
                
                $dokumentasi = $request->file('dokumentasi_feeder');
                $format_name_dokumentasi = time() .'feeder'. '.' . $dokumentasi->extension();
                $dokumentasi->storeAs($path, $format_name_dokumentasi, 'public');
                $ajax->dokumentasi_feeder = $format_name_dokumentasi;


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
           
    }

    public function fdt(Request $request, string $id_pm)
    {
         $rule = [
            'box_fdt' => 'required',
            'kebersihan_fdt' => 'required',
            'all_port_fdt' => 'required',
            'port_fdt_redaman' => 'required',
            'dokumentasi_fdt' => 'required',
        ];

        $message = [
            'box_fdt.required' => 'Tidak boleh kosong',
            'kebersihan_fdt.required' => 'Tidak boleh kosong',
            'all_port_fdt.required' => 'Tidak boleh kosong',
            'port_fdt_redaman.required' => 'Tidak boleh kosong',
            'dokumentasi_fdt.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

         $ajax = Pm::find($id_pm);
            if($ajax) {
                $path = 'files/pm';
                $ajax->is_fdt = 1;
                $ajax->box_fdt = $request->input('box_fdt');
                $ajax->catatan_box_fdt = $request->input('catatan_box_fdt');
                
                $ajax->kebersihan_fdt = $request->input('kebersihan_fdt');
                $ajax->catatan_kebersihan_fdt = $request->input('catatan_kebersihan_fdt');

                $ajax->all_port_fdt = $request->input('all_port_fdt');
                $ajax->catatan_all_port_fdt = $request->input('catatan_all_port_fdt');

                $ajax->port_fdt_redaman = $request->input('port_fdt_redaman');
                $ajax->catatan_port_fdt_redaman = $request->input('catatan_port_fdt_redaman');
             
                $dokumentasi = $request->file('dokumentasi_fdt');
                $format_name_dokumentasi = time() .'fdt'. '.' . $dokumentasi->extension();
                $dokumentasi->storeAs($path, $format_name_dokumentasi, 'public');
                $ajax->dokumentasi_fdt = $format_name_dokumentasi;


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
           
    }

    public function fat(Request $request, string $id_pm)
    {
         $rule = [
            'box_fat' => 'required',
            'kebersihan_fat' => 'required',
            'all_port_fat' => 'required',
            'port_fat_redaman' => 'required',
            'dokumentasi_fat' => 'required',
        ];

        $message = [
            'box_fat.required' => 'Tidak boleh kosong',
            'kebersihan_fat.required' => 'Tidak boleh kosong',
            'all_port_fat.required' => 'Tidak boleh kosong',
            'port_fat_redaman.required' => 'Tidak boleh kosong',
            'dokumentasi_fat.required' => 'Tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {

         $ajax = Pm::find($id_pm);
            if($ajax) {
                $path = 'files/pm';
                $ajax->is_fat = 1;
                $ajax->box_fat = $request->input('box_fat');
                $ajax->catatan_box_fat = $request->input('catatan_box_fat');
                
                $ajax->kebersihan_fat = $request->input('kebersihan_fat');
                $ajax->catatan_kebersihan_fat = $request->input('catatan_kebersihan_fat');

                $ajax->all_port_fat = $request->input('all_port_fat');
                $ajax->catatan_all_port_fat = $request->input('catatan_all_port_fat');

                $ajax->port_fat_redaman = $request->input('port_fat_redaman');
                $ajax->catatan_port_fat_redaman = $request->input('catatan_port_fat_redaman');
             
                $dokumentasi = $request->file('dokumentasi_fat');
                $format_name_dokumentasi = time() .'fat'. '.' . $dokumentasi->extension();
                $dokumentasi->storeAs($path, $format_name_dokumentasi, 'public');
                $ajax->dokumentasi_fat = $format_name_dokumentasi;


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
           
    }
}
