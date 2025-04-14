<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use Illuminate\Support\Facades\Auth;

class SimpananController extends Controller
{
    /**
     * Menampilkan halaman index simpanan
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.simpanan.index-simpanan ');
    }
}
