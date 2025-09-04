<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JasaManasukaController extends Controller
{
    public function index()
    {
        return view('admin.jasa-manasuka.index-jasa-manasuka');
    }
}
