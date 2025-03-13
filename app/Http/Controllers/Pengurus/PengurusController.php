<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    public function index()
    {
        $users = Anggota::all(); 

        $jumlahAnggota = Anggota::count();

        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        return view('pengurus.dashboard', compact('users', 'jumlahAnggota', 'jumlahSaldo'));
    }
}
