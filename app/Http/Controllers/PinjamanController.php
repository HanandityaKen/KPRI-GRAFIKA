<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Menampilkan halaman index pinjaman
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pinjaman.index-pinjaman');
    }
}
