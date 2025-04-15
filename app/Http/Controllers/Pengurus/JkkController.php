<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JkkController extends Controller
{
    /**
     * Menampilkan halaman jkk di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function jkk()
    {
        return view('pengurus.kas-harian.jkk');
    }

    /**
     * Menampilkan halaman rekap jkk di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function rekapJkk()
    {
        return view('pengurus.kas-harian.rekap-jkk');
    }
}
