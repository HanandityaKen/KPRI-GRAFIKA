<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jkk;
use App\Models\KasHarian;

class JkkController extends Controller
{
    /**
     * Menampilkan halaman jkk
     * 
     * @return \Illuminate\View\View
     */
    public function jkk()
    {
        return view('admin.kas-harian.jkk');
    }

    /**
     * Menampilkan halaman rekap jkk
     * 
     * @return \Illuminate\View\View
     */
    public function rekapJkk()
    {
        return view('admin.kas-harian.rekap-jkk');
    }
}
