<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JkmController extends Controller
{
    /**
     * Menampilkan halaman jkm di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function jkm()
    {
        return view('pengurus.kas-harian.jkm');
    }

    /**
     * Menampilkan halaman rekap jkm di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function rekapJkm()
    {
        return view('pengurus.kas-harian.rekap-jkm');
    }
}
