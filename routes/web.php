<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;

// Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// });

//Admin
Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-example', [AdminController::class, 'example'])->name('dashboard-example');
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');

});
