<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kota;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\SiswaController;
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


// cek view adminlte saja
Route::get('/lteadmin', function () {
    return view('layout.adminlte');
});

// login
Route::get('/', function () {
    return view('login');
})->name('loginForm');

Route::post('/loginProcess', [AuthController::class, "login"])->name('loginProcess');


// Siswa
Route::get('/dashboard/data', [SiswaController::class, 'index'])->name('data');

Route::post('/dashboard/data/create', [SiswaController::class, 'store'])->name('storeData');

Route::get('/dashboard/data/edit/{nis}', [SiswaController::class, 'edit'])->name('editData');

Route::put('/dashboard/data/{nis}', [SiswaController::class, 'update'])->name('updateData');

Route::delete('/dashboard/data/delete/{nis}', [SiswaController::class, 'destroy'])->name('deleteData');

// kota
Route::get('/dashboard/kota', [KotaController::class, 'index'])->name('kota');
Route::post('/dashboard/kota/create', [KotaController::class, 'store'])->name('storeKota');



// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
