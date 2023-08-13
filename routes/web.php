<?php

use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisKegiatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MppController;
use App\Http\Controllers\OltController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/home/search', [DashboardController::class, 'home_cari'])->name('home.cari');


    Route::get('/rooms', [RoomsController::class, 'home'])->name('rooms.dashboard');
    Route::get('/rooms/fetch', [RoomsController::class, 'rooms']);
    Route::post('/rooms/store', [RoomsController::class, 'store']);
    Route::get('/rooms/edit/{id}', [RoomsController::class, 'edit']);
    Route::post('/rooms/update/{id}', [RoomsController::class, 'update']);
    Route::delete('/rooms/delete/{id}', [RoomsController::class, 'destroy']);


    Route::get('/reservations', [ReservationController::class, 'home'])->name('reservations.dashboard');


    Route::get('/calendars', [CalendarsController::class, 'home'])->name('calendars.dashboard');
    Route::get('/calendars/event{id}', [CalendarsController::class, 'event']);


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
    Route::post('/radius/store', [RadiusController::class, 'store']);
    Route::get('/radius/fetch', [RadiusController::class, 'fetch']);
    Route::get('/radius/edit/{id}', [RadiusController::class, 'edit']);
    Route::put('/radius/update/{id}', [RadiusController::class, 'update']);
    // Route::delete('/radius/delete/{id}', [RadiusController::class, 'destroy']);


});

require __DIR__ . '/auth.php';
