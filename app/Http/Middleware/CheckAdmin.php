<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware CheckAdmin
 * 
 * Middleware ini digunakan untuk memverifikasi apakah pengguna yang sedang login
 * menggunakan guard `admin`. Jika tidak, pengguna akan diarahkan ke halaman login admin.
 * 
 * @package App\Http\Middleware
 */
class CheckAdmin
{
    /**
     * Menangani permintaan masuk dan memverifikasi autentikasi admin.
     *
     * Middleware ini memeriksa apakah pengguna terautentikasi dengan guard 'admin'.
     * Jika tidak, pengguna akan diarahkan ke rute login admin.
     *
     * @param  \Illuminate\Http\Request  $request  Objek permintaan HTTP yang masuk.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next  Closure untuk meneruskan permintaan ke lapisan berikutnya.
     * @return \Symfony\Component\HttpFoundation\Response  Respon HTTP setelah pemeriksaan autentikasi.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
