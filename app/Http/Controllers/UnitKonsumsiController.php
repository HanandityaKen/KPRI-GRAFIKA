<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitKonsumsiController extends Controller
{
    /**
     * Menampilkan halaman index unit konsumsi di admin
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.unit-konsumsi.index-unit-konsumsi');
    }
}
