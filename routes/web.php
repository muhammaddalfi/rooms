<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
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
    Route::get('/',[DashboardController::class,'home'])->name('home.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/rooms',[RoomsController::class,'home'])->name('rooms.dashboard');
    Route::get('/rooms/fetch', [RoomsController::class, 'rooms']);
    Route::post('/rooms/store', [RoomsController::class, 'store']);
    Route::get('/rooms/edit/{id}', [RoomsController::class,'edit']);
    Route::post('/rooms/update/{id}', [RoomsController::class,'update']);
    Route::delete('/rooms/delete/{id}', [RoomsController::class, 'destroy']);
});

require __DIR__.'/auth.php';
