<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PengurusController;

//Admin
Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');
Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-example', [AdminController::class, 'example'])->name('dashboard-example');
    Route::resource('anggota', AnggotaController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('pengurus', PengurusController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

