<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Simpanan;

class SimpananController extends Controller
{
    public function index()
    {
        return view('pengurus.simpanan.index-simpanan ');
    }
}
