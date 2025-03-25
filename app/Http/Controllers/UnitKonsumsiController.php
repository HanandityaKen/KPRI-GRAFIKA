<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitKonsumsiController extends Controller
{
    public function index()
    {
        return view('admin.unit-konsumsi.index-unit-konsumsi');
    }
}
