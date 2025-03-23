<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        return view('pengurus.pinjaman.index-pinjaman');
    }
}
