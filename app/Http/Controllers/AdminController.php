<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data anggota, simpanan, dan saldo.
     *
     * @return \Illuminate\View\View
    */
    public function index()
    {
        // Mengambil semua data anggota dari database
        $users = Anggota::all(); 

        // Menghitung jumlah anggota
        $jumlahAnggota = Anggota::count();

        // Menghitung total simpanan dari semua anggota
        $totalSimpanan = Simpanan::sum('total');

        // Mengambil saldo koperasi terakhir dari database
        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        // Menampilkan halaman dashboard admin dengan data semua anggota, jumlah anggota, total simpanan, dan saldo koperasi
        return view('admin.dashboard', compact('users', 'jumlahAnggota', 'totalSimpanan' , 'jumlahSaldo'));
    }
}
