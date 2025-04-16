<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware CheckPengurus
 * 
 * Middleware ini digunakan untuk memverifikasi apakah pengguna yang sedang login
 * menggunakan guard `pengurus`. Jika tidak, pengguna akan diarahkan ke halaman login pengurus.
 * 
 * @package App\Http\Middleware
 */
class CheckPengurus
{
    /**
     * Menangani permintaan masuk dan memverifikasi autentikasi pengurus.
     *
     * Middleware ini memeriksa apakah pengguna terautentikasi dengan guard 'pengurus'.
     * Jika tidak, pengguna akan diarahkan ke rute login pengurus.
     *
     * @param  \Illuminate\Http\Request  $request  Objek permintaan HTTP yang masuk.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next  Closure untuk meneruskan permintaan ke lapisan berikutnya.
     * @return \Symfony\Component\HttpFoundation\Response  Respon HTTP setelah pemeriksaan autentikasi.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('pengurus')->check()) {
            return redirect()->route('pengurus.login');
        }

        return $next($request);
    }
}
