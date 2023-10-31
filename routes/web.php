<?php

use App\Http\Controllers\BadDebController;
use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\DashboardBaddebt;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKeluhanController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\JenisKeluhanController;
use App\Http\Controllers\KategoriDebt;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanDebt;
use App\Http\Controllers\MppController;
use App\Http\Controllers\OltController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadiusController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UplineController;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'home'])->name('home.dashboard');
    Route::put('/update/password/{id}',[PasswordController::class,'update']);
    Route::post('/home/search', [DashboardController::class, 'home_cari'])->name('home.cari');

    Route::get('/dailys', [KegiatanController::class, 'home'])->name('daily.dashboard');
    Route::post('/dailys/store', [KegiatanController::class, 'store']);
    Route::get('/dailys/fetch', [KegiatanController::class, 'daily']);
    Route::get('/dailys/edit/{id}', [KegiatanController::class, 'edit']);
    Route::post('/dailys/update/{id}', [KegiatanController::class, 'update']);
    Route::delete('/dailys/delete/{id}', [KegiatanController::class, 'destroy']);
    Route::get('/dailys/show/{id}', [KegiatanController::class, 'show']);
    Route::get('/dailys/reload/{lat}/{lng}', [KegiatanController::class, 'reload_olt']);
    Route::get('/dailys/olts', [KegiatanController::class, 'olts']);

    Route::get('/activity', [JenisKegiatanController::class, 'home'])->name('activity.dashboard');
    Route::post('/activity/store', [JenisKegiatanController::class, 'store']);
    Route::get('/activity/fetch', [JenisKegiatanController::class, 'activity']);
    Route::get('/activity/edit/{id}', [JenisKegiatanController::class, 'edit']);
    Route::put('/activity/update/{id}', [JenisKegiatanController::class, 'update']);
    Route::delete('/activity/delete/{id}', [JenisKegiatanController::class, 'destroy']);

    Route::get('/olt', [OltController::class, 'home'])->name('olt.dashboard');
    Route::post('/olt/store', [OltController::class, 'store']);
    Route::get('/olt/fetch', [OltController::class, 'olt']);
    Route::get('/olt/edit/{id}', [OltController::class, 'edit']);
    Route::put('/olt/update/{id}', [OltController::class, 'update']);
    Route::delete('/olt/delete/{id}', [OltController::class, 'destroy']);
    Route::post('/import/olt', [OltController::class, 'import']);

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.dashboard');
    Route::post('/pengguna/store', [PenggunaController::class, 'store']);
    Route::get('/pengguna/fetch', [PenggunaController::class, 'fetch']);
    // Route::get('/pengguna/edit/{id}', [PenggunaController::class,'edit']);
    // Route::put('/pengguna/update/{id}', [PenggunaController::class,'update']);
    Route::delete('/pengguna/delete/{id}', [PenggunaController::class, 'destroy']);

    Route::get('/upline', [UplineController::class, 'index'])->name('upline.dashboard');
    Route::post('/upline/store', [UplineController::class, 'store']);
    Route::get('/upline/fetch', [UplineController::class, 'fetch']);
    Route::get('/upline/edit/{id}', [UplineController::class, 'edit']);
    Route::put('/upline/update/{id}', [UplineController::class, 'update']);
    Route::delete('/upline/delete/{id}', [UplineController::class, 'destroy']);


    Route::get('/mpp', [MppController::class, 'index'])->name('mpp.dashboard');
    Route::post('/mpp/store', [MppController::class, 'store']);
    Route::get('/mpp/fetch', [MppController::class, 'fetch']);
    Route::get('/mpp/edit/{id}', [MppController::class, 'edit']);
    Route::put('/mpp/update/{id}', [MppController::class, 'update']);
    Route::delete('/mpp/delete/{id}', [MppController::class, 'destroy']);

    Route::get('/radius', [RadiusController::class, 'index'])->name('radius.dashboard');
    Route::get('/radius/fetch', [RadiusController::class, 'fetch']);
    Route::get('/radius/edit/{id}', [RadiusController::class, 'edit']);
    Route::put('/radius/update/{id}', [RadiusController::class, 'update']);

    // Anggota Perusahaan
    Route::post('/perusahaan/anggota', [MppController::class, 'store_anggota']);
    Route::get('/perusahaan/anggota/list', [MppController::class, 'show_anggota']);
    Route::get('/perusahaan/anggota/edit/{id}', [MppController::class, 'edit_anggota']);
    Route::put('/perusahaan/anggota/update/{id}', [MppController::class, 'update_anggota']);

    // Anggota Leader
    Route::post('/leader/anggota', [UplineController::class, 'store_anggota']);
    Route::get('/leader/anggota/list', [UplineController::class, 'show_anggota']);
    Route::get('/leader/anggota/edit/{id}', [UplineController::class, 'edit_anggota']);
    Route::get('/leader/{id}', [UplineController::class, 'show_leader']);
    Route::put('/leader/anggota/update/{id}', [UplineController::class, 'update_anggota']);

    Route::get('/keluhan', [KeluhanController::class, 'home'])->name('keluhan.dashboard');
    Route::get('/map/keluhan/reload/{lat}/{lng}', [KeluhanController::class, 'reload_olt']);
    Route::post('/keluhan/store', [KeluhanController::class, 'store']);
    Route::get('/keluhan/fetch', [KeluhanController::class, 'keluhan']);
    Route::get('/keluhan/show/{id}', [KeluhanController::class, 'show']);

    
    Route::get('/dashboard/keluhan', [DashboardKeluhanController::class, 'home'])->name('dashboard.keluhan');
    Route::post('/keluhan/search', [DashboardKeluhanController::class, 'home_cari'])->name('cari.keluhan');

    Route::get('/jenis_keluhan', [JenisKeluhanController::class, 'home'])->name('jenis_keluhan.dashboard');
    Route::post('/jenis_keluhan/store', [JenisKeluhanController::class, 'store']);
    Route::get('/jenis_keluhan/fetch', [JenisKeluhanController::class, 'jenis_keluhan']);
    Route::get('/jenis_keluhan/edit/{id}', [JenisKeluhanController::class, 'edit']);
    Route::put('/jenis_keluhan/update/{id}', [JenisKeluhanController::class, 'update']);
    Route::delete('/jenis_keluhan/delete/{id}', [JenisKeluhanController::class, 'destroy']);


    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/fetch', [RoleController::class, 'fetch']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::get('/role/{id}', [RoleController::class, 'edit']);
    Route::put('/role/{id}', [RoleController::class, 'update']);
    Route::delete('/role/{id}', [RoleController::class, 'destroy']);

    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/fetch', [PermissionController::class, 'fetch']);
    Route::post('/permission', [PermissionController::class, 'store']);
    Route::get('/permission/{id}', [PermissionController::class, 'edit']);
    Route::put('/permission/{id}', [PermissionController::class, 'update']);
    Route::delete('/permission/{id}', [PermissionController::class, 'destroy']);

    Route::get('/dashboard/baddebt', [DashboardBaddebt::class, 'index'])->name('dashboard');
    Route::get('/baddeb', [BadDebController::class, 'index'])->name('baddeb.index');
    Route::get('/baddeb/fetch', [BadDebController::class, 'fetch']);
    Route::post('/baddeb', [BadDebController::class, 'store']);
    Route::get('/baddeb/{id}', [BadDebController::class, 'edit']);
    Route::post('/baddeb/{id}', [BadDebController::class, 'update']);
    Route::delete('/baddeb/{id}', [BadDebController::class, 'destroy']);

    Route::get('/katdeb', [KategoriDebt::class, 'index'])->name('katdeb.index');
    Route::get('/katdeb/fetch', [KategoriDebt::class, 'fetch']);
    Route::post('/katdeb', [KategoriDebt::class, 'store']);
    Route::get('/katdeb/{id}', [KategoriDebt::class, 'edit']);
    Route::put('/katdeb/{id}', [KategoriDebt::class, 'update']);
    Route::delete('/katdeb/{id}', [KategoriDebt::class, 'destroy']);


    Route::get('/laporan',[LaporanController::class,'index'])->name('laporan.index');
    Route::get('/laporan/fetch', [LaporanController::class, 'fetch']);
    Route::get('/laporan/search', [LaporanController::class, 'search'])->name('laporan.search');

    Route::get('/report/baddeb',[LaporanDebt::class,'index'])->name('report.index');
    Route::get('/report/fetch', [LaporanDebt::class, 'fetch']);
    Route::get('/report/search', [LaporanDebt::class, 'search'])->name('report.search');

});

require __DIR__ . '/auth.php';
