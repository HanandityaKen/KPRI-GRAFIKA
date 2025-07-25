<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasHarian;
use App\Models\Saldo;

class RiwayatSaldoController extends Controller
{
    public function index()
    {
        return view('admin.riwayat-saldo.riwayat-saldo-index');
    }
}
