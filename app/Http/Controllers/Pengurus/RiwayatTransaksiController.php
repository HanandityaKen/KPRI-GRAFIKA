<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasHarian;

class RiwayatTransaksiController extends Controller
{
    public function index()
    {
        return view('pengurus.riwayat-transaksi.index-riwayat-transaksi');
    }

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
            'b_umum' => 'Biaya Umum',
            'b_orgns' => 'Biaya Organisasi',
            'b_oprs' => 'Biaya Operasional',
            'b_lain' => 'Biaya Lain-lain',
            'tnh_kav' => 'Tanah Kavling',
        ];

        return view('pengurus.riwayat-transaksi.detail', compact('riwayatTransaksi', 'fields'));
    }
}
