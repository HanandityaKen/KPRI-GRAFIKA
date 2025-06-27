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

    public function update(Request $request)
    {
        $request->validate([
            'saldo' => 'required'
        ]);

        $saldo = intval(str_replace(['Rp', '.', ' '], '', $request->saldo));

        $saldoKoperasi = Saldo::first();

        $saldoKoperasi->update([
            'saldo' => $saldo
        ]);

        return redirect()->route('admin.saldo-koperasi-index')->with('success', 'Berhasil Mengubah Saldo Koperasi');
    }
}
