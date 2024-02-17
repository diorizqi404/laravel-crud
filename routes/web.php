<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kota;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth; // Add this line
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
// Route::get('/lteadmin', function () {
//     return view('layout.adminlte');
// });

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/loginProcess', [AuthController::class, "login"])->name('loginProcess');


// Siswa
Route::get('/dashboard/data', [SiswaController::class, 'index'])->name('data')->middleware('auth');

Route::post('/dashboard/data/create', [SiswaController::class, 'store'])->name('storeData')->middleware('auth');

Route::get('/dashboard/data/edit/{nis}', [SiswaController::class, 'edit'])->name('editData')->middleware('auth');

Route::put('/dashboard/data/{nis}', [SiswaController::class, 'update'])->name('updateData')->middleware('auth');

Route::delete('/dashboard/data/delete/{id}', [SiswaController::class, 'destroy'])->name('deleteData')->middleware('auth');

// kota
Route::get('/dashboard/kota', [KotaController::class, 'index'])->name('kota')->middleware('auth');
Route::post('/dashboard/kota/create', [KotaController::class, 'store'])->name('storeKota')->middleware('auth');
Route::get('/dashboard/kota/edit/{id}', [KotaController::class, 'edit'])->name('editKota')->middleware('auth');
Route::put('/dashboard/kota/{id}', [KotaController::class, 'update'])->name('updateKota')->middleware('auth');
Route::delete('/dashboard/kota/delete/{id}', [KotaController::class, 'destroy'])->name('deleteKota')->middleware('auth');

Auth::routes();

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
