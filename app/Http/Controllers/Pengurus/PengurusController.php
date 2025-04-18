<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    /**
     * Menampilkan halaman dashboard pengurus dengan data anggota, simpanan, dan saldo.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = Anggota::all(); 

        $jumlahAnggota = Anggota::count();

        $totalSimpanan = Simpanan::sum('total');

        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        return view('pengurus.dashboard', compact('users', 'jumlahAnggota', 'totalSimpanan', 'jumlahSaldo'));
    }
}
