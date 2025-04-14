<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jkm;
use App\Models\KasHarian;

class JkmController extends Controller
{
    /**
     * Menampilkan halaman jkm
     * 
     * @return \Illuminate\View\View
     */
    public function jkm()
    {
        return view('admin.kas-harian.jkm');
    }

    /**
     * Menampilkan halaman rekap jkm
     * 
     * @return \Illuminate\View\View
     */
    public function rekapJkm()
    {
        return view('admin.kas-harian.rekap-jkm');
    }
}
