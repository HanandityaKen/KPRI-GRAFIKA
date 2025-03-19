<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index()
    {
        return view('pengurus.angsuran.index-angsuran');
    }
}
