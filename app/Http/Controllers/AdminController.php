<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = Anggota::all(); 

        $jumlahAnggota = Anggota::count();

        $jumlahSaldo = Saldo::first()?->saldo ?? 0;

        return view('admin.dashboard', compact('users', 'jumlahAnggota', 'jumlahSaldo'));
    }

    //file ori
    public function example()
    {
        return view('admin.dashboard-example');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
