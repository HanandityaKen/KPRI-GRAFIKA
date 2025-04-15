<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Menampilkan halaman index pinjaman di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengurus.pinjaman.index-pinjaman');
    }
}
