<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitKonsumsiController extends Controller
{
    /**
     * Menampilkan halaman index unit konsumsi di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengurus.unit-konsumsi.index-unit-konsumsi');
    }
}
