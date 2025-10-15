<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasHarian;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'lain_lain' => $riwayatTransaksi->jenis_transaksi === 'kas keluar' ? 'Beban Lain' : 'Lain-lain',
            'barang_kons' => 'Barang atau Unit Konsumsi',
            'piutang' => 'Piutang',
            'hutang' => 'Pinjaman',
            'hari_lembur' => 'Hari Lembur',
            'perjalanan_pengawas' => 'Perjalanan Pengawas',
            'thr' => 'THR',
            'admin' => 'Admin',
            'iuran_dekopinda' => 'Iuran Dekopinda',
            'honor_pengurus' => 'Honor Pengurus',
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
            'dana_kesejahteraan' => 'Dana Kesejahteraan',
            'pembayaran_listrik_dan_air' => 'Pembayaran Listrik dan Air',
            'tnh_kav' => 'Tanah Kavling',
        ];

        return view('admin.riwayat-transaksi.detail', compact('riwayatTransaksi', 'fields'));
    }

    public function downloadStruk($id)
    {
        $kasHarian = KasHarian::findOrFail($id);

        if ($kasHarian->jenis_transaksi === 'kas masuk') {
            $uangSejumlah = ($kasHarian->pokok ?? 0)
                + ($kasHarian->wajib ?? 0)
                + ($kasHarian->manasuka ?? 0)
                + ($kasHarian->wajib_pinjam ?? 0)
                + ($kasHarian->qurban ?? 0)
                + ($kasHarian->lain_lain ?? 0)
                + ($kasHarian->jasa ?? 0);

                if ($kasHarian->angsuran > 0) {
                    $uangSejumlah += $kasHarian->angsuran;
                } elseif ($kasHarian->barang_kons > 0) {
                    $uangSejumlah += $kasHarian->barang_kons;
                }
        } elseif ($kasHarian->jenis_transaksi === 'kas keluar') {
            $uangSejumlah = ($kasHarian->pokok ?? 0)
                + ($kasHarian->wajib ?? 0)
                + ($kasHarian->manasuka ?? 0)
                + ($kasHarian->wajib_pinjam ?? 0)
                + ($kasHarian->qurban ?? 0);

                if ($kasHarian->hutang > 0) {
                    $uangSejumlah += $kasHarian->hutang;
                } elseif ($kasHarian->barang_kons > 0) {
                    $uangSejumlah += $kasHarian->barang_kons;
                }
        }

        $pdf = Pdf::loadView('admin.kas-harian.struk-pdf', compact('kasHarian', 'uangSejumlah'))
                ->setPaper('A5', 'portrait');

        // ->setPaper([0, 0, 420, 430], 'portrait');

        // return $pdf->download('Struk_KasHarian_'.$kasHarian->id.'.pdf');

        return $pdf->stream('Struk_KasHarian_'.$kasHarian->id.'.pdf');
    }
}
