<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JkkController extends Controller
{
    public function jkk()
    {
        return view('pengurus.kas-harian.jkk');
    }

    public function rekapJkk()
    {
        return view('pengurus.kas-harian.rekap-jkk');
    }
}
