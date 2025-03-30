<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    // //Anggota
    public function showAnggotaLoginForm()
    {
        return view ('auth.anggota-login');
    }

    public function anggotaLoginProses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('anggota')->attempt(['nama' => $request->nama, 'password' => $request->password])) {
            return back()->withErrors([
                'error' => 'Nama atau Password yang Anda Masukan Salah!'
            ]);
        }

        return redirect()->intended(route('dashboard'));
    }
    
    public function logoutAnggota(Request $request)
    {
        session()->flush();

        Auth::guard('anggota')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
    
        return redirect()->route('anggota.login');
    }
    
    //Pengurus
    public function showPengurusLoginForm()
    {
        return view('auth.pengurus-login');
    }
    
    public function pengurusLoginProses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('pengurus')->attempt(['nama' => $request->nama, 'password' => $request->password])) {
            return back()->withErrors([
                'error' => 'Nama atau Password yang Anda Masukan Salah!'
            ]);
        }

        $user = Auth::guard('pengurus')->user();

        if (!$user || $user->posisi !== 'pengurus') {
            Auth::guard('pengurus')->logout();
            return back()->withErrors([
                'error' => 'Anda tidak memiliki izin',
            ]);
        }

        return redirect()->intended(route('pengurus.dashboard'));
        
    }

    public function logoutPengurus(Request $request)
    {
        Auth::guard('pengurus')->logout();
        
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        return redirect()->route('pengurus.login');
    }
    
    //Admin
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLoginProses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return back()->withErrors([
                'error'    => 'Username atau Password yang Anda Masukan Salah!'
            ]);
        }

        return redirect()->intended(route('admin.dashboard'));
        
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }

}

    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    // public function loginProses(Request $request)
    // {
    //     $request->validate([
    //         'nama'      => 'required|string',
    //         'password'  => 'required|string',
    //     ]);

    //     $guards = [
    //         'anggota'   => 'kpri-grafika',
    //         'pengurus'  => 'pengurus.index',
    //         'admin'     => 'admin.index',
    //     ];

    //     foreach ($guards as $guard => $route) {
    //         if (Auth::guard($guard)->attempt([
    //             'nama' => $request->nama,
    //             'password' => $request->password
    //         ])) {
    //             return redirect()->intended(route($route));
    //         }
    //     }

    //     return back()->withErrors([
    //         'username' => 'Username atau password salah',
    //     ]);
    // }