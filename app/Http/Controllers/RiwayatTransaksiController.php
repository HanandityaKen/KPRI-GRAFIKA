<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasHarian;

class RiwayatTransaksiController extends Controller
{
    /**
     * Menampilkan halaman index riwayat transaksi di admin
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.riwayat-transaksi.index-riwayat-transaksi');
    }

    /**
     * Menampilkan halaman detail riwayat transaksi berdasarkan id
     * 
     * Mengubah nama field dari database ke nama yang sudah ditentukan untuk ditampilkan di halaman detail riwayat transaksi 
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function detail($id)
    {
        $riwayatTransaksi = KasHarian::findOrFail($id);

        $fields = [
            'pokok' => 'Pokok',
            'wajib' => 'Wajib',
            'manasuka' => 'Manasuka',
            'wajib_pinjam' => 'Wajib Pinjam',
            'qurban' => 'Qurban',
            'angsuran' => 'Angsuran',
            'jasa' => 'Jasa',
            'js_admin' => 'Jasa Admin',
            'lain_lain' => 'Lain-lain',
            'barang_kons' => 'Barang atau Unit Konsumsi',
            'piutang' => 'Piutang',
            'hutang' => 'Pinjaman',
            'hari_lembur' => 'Hari Lembur',
            'perjalanan_pengawas' => 'Perjalanan Pengawas',
            'thr' => 'THR',
            'admin' => 'Admin',
            'iuran_dekopinda' => 'Iuran Dekopinda',
            'rkrab' => 'RkRab',
            'pembinaan' => 'Pembinaan',
            'harkop' => 'Harkop',
            'dandik' => 'Dandik',
            'rapat' => 'Rapat',
            'jasa_manasuka' => 'Jasa Manasuka',
            'pajak' => 'Pajak',
            'tabungan_qurban' => 'Tabungan Qurban',
            'dekopinda' => 'Dekopinda',
            'wajib_pkpri' => 'Wajib PKPRI',
            'dansos' => 'Dansos',
            'shu' => 'SHU',
            'dana_pengurus' => 'Dana Pengurus',
            'tnh_kav' => 'Tanah Kavling',
        ];

        return view('admin.riwayat-transaksi.detail', compact('riwayatTransaksi', 'fields'));
    }
}
