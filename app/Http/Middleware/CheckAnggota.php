<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware CheckAnggota
 * 
 * Middleware ini digunakan untuk memverifikasi apakah pengguna yang sedang login
 * menggunakan guard `anggota`. Jika tidak, pengguna akan diarahkan ke halaman login anggota.
 * 
 * @package App\Http\Middleware
 */
class CheckAnggota
{
    /**
     * Menangani permintaan masuk dan memverifikasi autentikasi anggota.
     *
     * Middleware ini memeriksa apakah pengguna terautentikasi dengan guard 'anggota'.
     * Jika tidak, pengguna akan diarahkan ke rute login anggota.
     *
     * @param  \Illuminate\Http\Request  $request  Objek permintaan HTTP yang masuk.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next  Closure untuk meneruskan permintaan ke lapisan berikutnya.
     * @return \Symfony\Component\HttpFoundation\Response  Respon HTTP setelah pemeriksaan autentikasi.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('anggota')->check()) {
            return redirect()->route('anggota.login');
        }

        return $next($request);
    }
}
