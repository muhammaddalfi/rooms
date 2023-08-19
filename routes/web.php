<?php

use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKeluhanController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\JenisKeluhanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\MppController;
use App\Http\Controllers\OltController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RadiusController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UplineController;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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
});

require __DIR__ . '/auth.php';
