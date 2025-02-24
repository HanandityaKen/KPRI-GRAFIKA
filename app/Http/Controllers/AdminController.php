<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = Anggota::all(); 

        return view('admin.dashboard', compact('users'));
    }

    //file ori
    public function example()
    {
        return view('admin.dashboard-example');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
