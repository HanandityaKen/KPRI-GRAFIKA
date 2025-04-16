<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware NoCache
 * 
 * Middleware ini digunakan untuk mengatur header cache pada respons HTTP.
 * Ini memastikan bahwa respons tidak disimpan dalam cache oleh browser atau proxy.
 * 
 * Fungsi utama midlleware ini adalah saat setelah logout tidak bisa kembali ke halaman sebelumnya
 * 
 * @package App\Http\Middleware
 */
class NoCache
{
    /**
     * Menangani permintaan masuk dan menetapkan header untuk mencegah caching.
     *
     * Middleware ini menambahkan beberapa header HTTP (`Cache-Control`, `Pragma`, dan `Expires`)
     * guna memastikan bahwa respon tidak disimpan dalam cache oleh browser atau proxy.
     * 
     * Fungsi utama midlleware ini adalah saat setelah logout tidak bisa kembali ke halaman sebelumnya
     *
     * @param  \Illuminate\Http\Request  $request  Objek permintaan HTTP yang masuk.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next  Closure untuk meneruskan permintaan ke lapisan berikutnya.
     * @return \Symfony\Component\HttpFoundation\Response  Respon HTTP yang sudah diberi header no-cache.
     */

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
}
