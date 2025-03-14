<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JkmController extends Controller
{
    public function jkm()
    {
        return view('pengurus.kas-harian.jkm');
    }

    public function rekapJkm()
    {
        return view('pengurus.kas-harian.rekap-jkm');
    }
}
