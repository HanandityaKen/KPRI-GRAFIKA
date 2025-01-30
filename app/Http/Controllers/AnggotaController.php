<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('admin.anggota.index-anggota');
    }

    public function create(Request $request)
    {
        return view('admin.anggota.create-anggota');
    }
}
