<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AuthController;


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
