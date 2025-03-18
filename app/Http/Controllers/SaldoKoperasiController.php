<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saldo;

class SaldoKoperasiController extends Controller
{
    public function index()
    {
        $saldos = Saldo::first();
        return view('admin.saldo-koperasi.index-saldo-koperasi', compact('saldos'));
    }
}
