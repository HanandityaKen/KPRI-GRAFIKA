<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\KasHarianController;
use App\Http\Controllers\JkmController;
use App\Http\Controllers\JkkController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PersentaseController;

use App\Http\Controllers\Pengurus\PengurusController as SubPengurusController;
use App\Http\Controllers\Pengurus\KasHarianController as SubKasHarianController;
use App\Http\Controllers\Pengurus\JkmController as SubJkmController;
use App\Http\Controllers\Pengurus\JkkController as SubJkkController;
use App\Http\Controllers\Pengurus\SimpananController as SubSimpananController;
use App\Http\Controllers\Pengurus\PinjamanController as SubPinjamanController;

//Admin

Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin-login-proses', [AuthController::class, 'adminLoginProses'])->name('admin.login.proses');
Route::prefix('admin')->as('admin.')->middleware('admin', 'no-cache')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-example', [AdminController::class, 'example'])->name('dashboard-example');
    Route::resource('anggota', AnggotaController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('pengurus', PengurusController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('kas-harian', KasHarianController::class)->only(['index', 'create', 'store', 'edit','update', 'destroy']);
    Route::get('/jkm', [JkmController::class, 'jkm'])->name('jkm');
    Route::get('/jkk', [JkkController::class, 'jkk'])->name('jkk');
    Route::get('/rekap-jkm', [JkmController::class, 'rekapJkm'])->name('rekap-jkm');
    Route::get('/rekap-jkk', [JkkController::class, 'rekapJkk'])->name('rekap-jkk');
    Route::resource('simpanan', SimpananController::class)->only(['index']);
    Route::resource('pinjaman', PinjamanController::class)->only(['index']);
    Route::post('/setujui-pinjaman/{id}', [PinjamanController::class, 'setujuiPinjaman'])->name('setujui-pinjaman');
    Route::post('/tolak-pinjaman/{id}', [PinjamanController::class, 'tolakPinjaman'])->name('tolak-pinjaman');
    Route::resource('persentase', PersentaseController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout');
});

Route::get('/pengurus', [AuthController::class, 'showPengurusLoginForm'])->name('pengurus.login');
Route::post('/pengurus-login-proses', [AuthController::class, 'pengurusLoginProses'])->name('pengurus.login.proses');
Route::prefix('pengurus')->as('pengurus.')->middleware('pengurus', 'no-cache')->group(function () {
    Route::get('/dashboard', [SubPengurusController::class, 'index'])->name('dashboard');
    Route::resource('kas-harian', SubKasHarianController::class)->only(['index', 'create', 'store', 'edit','update', 'destroy']);
    Route::get('/jkm', [SubJkmController::class, 'jkm'])->name('jkm');
    Route::get('/jkk', [SubJkkController::class, 'jkk'])->name('jkk');
    Route::get('/rekap-jkm', [SubJkmController::class, 'rekapJkm'])->name('rekap-jkm');
    Route::get('/rekap-jkk', [SubJkkController::class, 'rekapJkk'])->name('rekap-jkk');
    Route::resource('simpanan', SubSimpananController::class)->only(['index']);
    Route::resource('pinjaman', SubPinjamanController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/logout-pengurus', [AuthController::class, 'logoutPengurus'])->name('logout');
});


