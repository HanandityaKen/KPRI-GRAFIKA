<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Simpanan;

class SimpananController extends Controller
{
    /**
     * Menampilkan halaman index simpanan di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengurus.simpanan.index-simpanan ');
    }
}
