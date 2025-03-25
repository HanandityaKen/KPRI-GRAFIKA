<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitKonsumsiController extends Controller
{
    public function index()
    {
        return view('pengurus.unit-konsumsi.index-unit-konsumsi');
    }
}
