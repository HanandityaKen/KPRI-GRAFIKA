<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    /**
     * Menampilkan halaman login anggota
     * 
     * @return \Illuminate\View\View 
     */
    public function showAnggotaLoginForm()
    {
        return view ('auth.anggota-login');
    }

    /**
     * Proses login anggota
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function anggotaLoginProses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        // Logout dari guard lain jika aktif
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        if (Auth::guard('pengurus')->check()) {
            Auth::guard('pengurus')->logout();
        }

        if (!Auth::guard('anggota')->attempt(['nama' => $request->nama, 'password' => $request->password])) {
            return back()->withErrors([
                'error' => 'Nama atau Password yang Anda Masukan Salah!'
            ]);
        }

        return redirect()->intended(route('dashboard'));
    }
    
    /**
     * Proses logout anggota
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAnggota(Request $request)
    {
        session()->flush();

        Auth::guard('anggota')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
    
        return redirect()->route('anggota.login');
    }
    
    /**
     * Menampilkan halaman login pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function showPengurusLoginForm()
    {
        return view('auth.pengurus-login');
    }
    
    /**
     * Proses login pengurus
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pengurusLoginProses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        // Logout dari guard lain jika aktif
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        if (Auth::guard('anggota')->check()) {
            Auth::guard('anggota')->logout();
        }

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

    /**
     * Proses logout pengurus
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutPengurus(Request $request)
    {
        Auth::guard('pengurus')->logout();
        
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        
        return redirect()->route('pengurus.login');
    }
    
    /**
     * Menampilkan halaman login admin
     * 
     * @return \Illuminate\View\View
     */
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Proses login admin
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLoginProses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Logout dari guard lain jika aktif
        if (Auth::guard('anggota')->check()) {
            Auth::guard('anggota')->logout();
        }
        if (Auth::guard('pengurus')->check()) {
            Auth::guard('pengurus')->logout();
        }

        if (!Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return back()->withErrors([
                'error'    => 'Username atau Password yang Anda Masukan Salah!'
            ]);
        }

        return redirect()->intended(route('admin.dashboard'));
        
    }

    /**
     * Proses logout admin
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }

    //dari anggota ke pengurus
    public function switchToPengurus()
    {
        $anggota = Auth::guard('anggota')->user();

        // Validasi: apakah user ini memang layak jadi pengurus?
        if ($anggota && $anggota->posisi === 'pengurus') {
            Auth::guard('anggota')->logout();

            Auth::guard('pengurus')->loginUsingId($anggota->id);

            return redirect()->route('pengurus.dashboard');
        }

        abort(403);
    }

    //dari pengurus ke anggota
    public function switchToAnggota()
    {
        $pengurus = Auth::guard('pengurus')->user();

        // Validasi: apakah user ini memang layak jadi anggota?
        if ($pengurus && $pengurus->posisi === 'pengurus') {
            Auth::guard('pengurus')->logout();

            Auth::guard('anggota')->loginUsingId($pengurus->id);

            return redirect()->route('dashboard');
        }

        abort(403);
    }

}