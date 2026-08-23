<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
Route::post('/divisi', [DivisiController::class,'store'])->name('divisi.store');

Route::get('/divisi/create', [DivisiController::class,'create'])->name('divisi.create');

Route::get('/divisi/{divisi}/edit', [DivisiController::class,'edit'])->name('divisi.edit');
Route::put('/divisi/{divisi}', [DivisiController::class,'update'])->name('divisi.update');

Route::delete('/divisi/{divisi}', [DivisiController::class, 'destroy'])->name('divisi.destroy');



// Authentication routes

// Registration routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'prosessregiseter'])->name('prosess.register');


// Login routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesslogin'])->name('prosess.login');

// Forgot password routes
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'prosessForgotPassword'])->name('prosess.forgot.password');

// Reset password routes
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'prosessResetPassword'])->name('prosess.reset.password');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Pegawai routes
//1.READ -> MENAMPILKAN DATA PEGAWAI
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

//2.CREATE -> MENAMPILKAN FORM UNTUK MENAMBAH DATA PEGAWAI
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');

//3. UPDATE -> MENAMPILKAN FORM UNTUK MENGEDIT DATA PEGAWAI
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');

//4. DELETE -> MENGHAPUS DATA PEGAWAI
Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

//5. EDIT -> MENAMPILKAN FORM UNTUK MENGEDIT DATA PEGAWAI
Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');

//6. UPDATE -> MEMPERBARUI DATA PEGAWAI
Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');

//7. SHOW -> MENAMPILKAN DETAIL DATA PEGAWAI
Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show');

//8. SEARCH -> MENCARI DATA PEGAWAI
Route::get('/pegawai/search', [PegawaiController::class, 'search'])->name('pegawai.search');