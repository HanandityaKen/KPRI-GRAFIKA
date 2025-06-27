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
use App\Http\Controllers\PengajuanPinjamanController;
use App\Http\Controllers\PersentaseController;
use App\Http\Controllers\SaldoKoperasiController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PengajuanUnitKonsumsiController;
use App\Http\Controllers\UnitKonsumsiController;
use App\Http\Controllers\AngsuranUnitKonsumsiController;
use App\Http\Controllers\RiwayatTransaksiController;
use App\Http\Controllers\WajibController;
use App\Http\Controllers\WajibPinjamController;
use App\Http\Controllers\PokokController;
use App\Http\Controllers\NamaKoperasiController;
use App\Http\Controllers\LogoKoperasiController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Pengurus\PengurusController as SubPengurusController;
use App\Http\Controllers\Pengurus\KasHarianController as SubKasHarianController;
use App\Http\Controllers\Pengurus\JkmController as SubJkmController;
use App\Http\Controllers\Pengurus\JkkController as SubJkkController;
use App\Http\Controllers\Pengurus\SimpananController as SubSimpananController;
use App\Http\Controllers\Pengurus\PengajuanPinjamanController as SubPengajuanPinjamanController;
use App\Http\Controllers\Pengurus\AngsuranController as SubAngsuranController;
use App\Http\Controllers\Pengurus\PinjamanController as SubPinjamanController;
use App\Http\Controllers\Pengurus\PengajuanUnitKonsumsiController as SubPengajuanUnitKonsumsiController;
use App\Http\Controllers\Pengurus\UnitKonsumsiController as SubUnitKonsumsiController;
use App\Http\Controllers\Pengurus\AngsuranUnitKonsumsiController as SubAngsuranUnitKonsumsiController;
use App\Http\Controllers\Pengurus\RiwayatTransaksiController as SubRiwayatTransaksiController;
use App\Http\Controllers\Pengurus\ProfileController as SubProfileController;
use App\Http\Controllers\Pengurus\AnggotaController as SubAnggotaController;

use App\Http\Controllers\Anggota\AnggotaController as AnggotaAnggotaController;

Route::get('/', [AuthController::class, 'showAnggotaLoginForm'])->name('anggota.login');
Route::post('/anggota-login-proses', [AuthController::class, 'anggotaLoginProses'])->name('anggota.login.proses');

Route::middleware('anggota', 'no-cache')->group(function () {
    Route::get('/dashboard', [AnggotaAnggotaController::class, 'index'])->name('dashboard');
    Route::get('/simpanan', [AnggotaAnggotaController::class, 'simpanan'])->name('simpanan');
    Route::get('/pinjaman', [AnggotaAnggotaController::class, 'pinjaman'])->name('pinjaman');
    Route::get('/unit-konsumsi', [AnggotaAnggotaController::class, 'unitKonsumsi'])->name('unit-konsumsi');
    Route::get('/riwayat', [AnggotaAnggotaController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/detail/{id}', [AnggotaAnggotaController::class, 'detailRiwayat'])->name('detail-riwayat');
    Route::get('/profile', [AnggotaAnggotaController::class, 'profile'])->name('profile');
    Route::put('/update-profile', [AnggotaAnggotaController::class, 'updateProfile'])->name('update-profile');
    Route::post('/logout-anggota', [AuthController::class, 'logoutAnggota'])->name('logout');
    Route::get('/switch-to-pengurus', [AuthController::class, 'switchToPengurus'])->name('switch-to-pengurus');
});

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
    Route::resource('pengajuan-pinjaman', PengajuanPinjamanController::class)->only(['index']);
    Route::post('/setujui-pengajuan-pinjaman/{id}', [PengajuanPinjamanController::class, 'setujuiPinjaman'])->name('setujui-pengajuan-pinjaman');
    Route::post('/tolak-pengajuan-pinjaman/{id}', [PengajuanPinjamanController::class, 'tolakPinjaman'])->name('tolak-pengajuan-pinjaman');
    Route::get('pengajuan-pinjaman/detail/{id}', [PengajuanPinjamanController::class, 'detail'])->name('detail-pengajuan-pinjaman');
    Route::resource('pinjaman', PinjamanController::class)->only(['index']);
    Route::resource('angsuran', AngsuranController::class)->only(['index', 'edit', 'update']);
    Route::resource('pengajuan-unit-konsumsi', PengajuanUnitKonsumsiController::class)->only(['index']);
    Route::post('/setujui-pengajuan-unit-konsumsi/{id}', [PengajuanUnitKonsumsiController::class, 'setujuiUnitKonsumsi'])->name('setujui-pengajuan-unit-konsumsi');
    Route::post('/tolak-pengajuan-unit-konsumsi/{id}', [PengajuanUnitKonsumsiController::class, 'tolakUnitKonsumsi'])->name('tolak-pengajuan-unit-konsumsi');
    Route::get('pengajuan-unit-konsumsi/detail/{id}', [PengajuanUnitKonsumsiController::class, 'detail'])->name('detail-pengajuan-unit-konsumsi');
    Route::resource('unit-konsumsi', UnitKonsumsiController::class)->only(['index']);
    Route::resource('angsuran-unit-konsumsi', AngsuranUnitKonsumsiController::class)->only(['index', 'edit', 'update']);
    Route::resource('riwayat-transaksi', RiwayatTransaksiController::class)->only(['index']);
    Route::get('riwayat-transaksi/detail/{id}', [RiwayatTransaksiController::class, 'detail'])->name('detail-riwayat-transaksi');
    Route::resource('persentase', PersentaseController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::get('/saldo-koperasi', [SaldoKoperasiController::class, 'index'])->name('saldo-koperasi-index');
    Route::put('/saldo-koperasi-update', [SaldoKoperasiController::class, 'update'])->name('saldo-koperasi-update');
    Route::resource('wajib', WajibController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('wajib-pinjam', WajibPinjamController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('pokok', PokokController::class)->only(['index', 'edit', 'update']);
    Route::get('/nama-koperasi', [NamaKoperasiController::class, 'index'])->name('nama-koperasi-index');
    Route::put('/nama-koperasi-update', [NamaKoperasiController::class, 'update'])->name('nama-koperasi-update');
    Route::get('/logo-koperasi', [LogoKoperasiController::class, 'index'])->name('logo-koperasi-index');
    Route::put('/logo-koperasi-update', [LogoKoperasiController::class, 'update'])->name('logo-koperasi-update');
    Route::resource('profile', ProfileController::class)->only(['index', 'update']);
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
    Route::resource('pengajuan-pinjaman', SubPengajuanPinjamanController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/setujui-pengajuan-pinjaman/{id}', [SubPengajuanPinjamanController::class, 'setujuiPinjaman'])->name('setujui-pengajuan-pinjaman');
    Route::post('/tolak-pengajuan-pinjaman/{id}', [SubPengajuanPinjamanController::class, 'tolakPinjaman'])->name('tolak-pengajuan-pinjaman');
    Route::get('pengajuan-pinjaman/detail/{id}', [SubPengajuanPinjamanController::class, 'detail'])->name('detail-pengajuan-pinjaman');
    Route::resource('pinjaman', SubPinjamanController::class)->only(['index']);
    Route::resource('angsuran', SubAngsuranController::class)->only(['index', 'edit', 'update']);
    Route::resource('pengajuan-unit-konsumsi', SubPengajuanUnitKonsumsiController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/setujui-pengajuan-unit-konsumsi/{id}', [SubPengajuanUnitKonsumsiController::class, 'setujuiUnitKonsumsi'])->name('setujui-pengajuan-unit-konsumsi');
    Route::post('/tolak-pengajuan-unit-konsumsi/{id}', [SubPengajuanUnitKonsumsiController::class, 'tolakUnitKonsumsi'])->name('tolak-pengajuan-unit-konsumsi');
    Route::get('pengajuan-unit-konsumsi/detail/{id}', [SubPengajuanUnitKonsumsiController::class, 'detail'])->name('detail-pengajuan-unit-konsumsi');
    Route::resource('unit-konsumsi', SubUnitKonsumsiController::class)->only(['index']);
    Route::resource('angsuran-unit-konsumsi', SubAngsuranUnitKonsumsiController::class)->only(['index', 'edit', 'update']);
    Route::resource('riwayat-transaksi', SubRiwayatTransaksiController::class)->only(['index']);
    Route::get('riwayat-transaksi/detail/{id}', [SubRiwayatTransaksiController::class, 'detail'])->name('detail-riwayat-transaksi');
    Route::resource('profile', SubProfileController::class)->only(['index', 'update']);
    Route::resource('anggota', SubAnggotaController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/logout-pengurus', [AuthController::class, 'logoutPengurus'])->name('logout');
    Route::get('/switch-to-anggota', [AuthController::class, 'switchToAnggota'])->name('switch-to-anggota');
});


