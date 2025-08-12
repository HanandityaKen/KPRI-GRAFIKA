<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\KasHarian;
use App\Models\RiwayatTabunganQurban;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Komponen Livewire untuk menampilkan riwayat transaksi anggota.
 *
 * Komponen ini menggunakan paginasi dan hanya menampilkan
 * data transaksi milik anggota yang sedang login.
 *
 * @property \Illuminate\Contracts\Auth\Authenticatable $anggota
 */
class RiwayatTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'tailwind';

    /**
     * Render komponen dan ambil data riwayat transaksi anggota.
     *
     * @return \Illuminate\View\View
     */
    // public function render()
    // {
    //     $anggotaId = Auth::guard('anggota')->user()->id;

    //     $riwayat = KasHarian::where('anggota_id', $anggotaId)
    //         ->orderByDesc('tanggal')
    //         ->orderByDesc('created_at')
    //         ->paginate(10)
    //         ->through(function ($item) {
    //             // Field yang jika ada isinya, transaksi akan dianggap tidak valid untuk ditampilkan
    //             $excludeFields = [
    //                 'hari_lembur', 'perjalanan_pengawas', 'thr', 'admin', 'iuran_dekopinda', 'honor_pengurus', 
    //                 'rkrab', 'pembinaan', 'harkop', 'dandik', 'rapat', 'jasa_manasuka', 
    //                 'pajak', 'tabungan_qurban', 'dekopinda', 'wajib_pkpri', 'dansos', 
    //                 'shu', 'dana_pengurus', 'dana_kesejahteraan', 'pembayaran_listrik_dan_air', 'tnh_kav'
    //             ];

    //             if ($item->jenis_transaksi === 'kas keluar') {
    //                 $excludeFields[] = 'lain_lain';
    //             }

    //             foreach ($excludeFields as $field) {
    //                 if (!empty($item->$field)) {
    //                     // Tandai sebagai transaksi yang tidak valid agar bisa disaring di Blade
    //                     $item->skip_render = true;
    //                     return $item;
    //                 }
    //             }

    //             $fields = [
    //                 'pokok' => 'Pokok',
    //                 'wajib' => 'Wajib',
    //                 'manasuka' => 'Manasuka',
    //                 'wajib_pinjam' => 'Wajib Pinjam',
    //                 'qurban' => 'Qurban',
    //                 'angsuran' => 'Angsuran',
    //                 'jasa' => 'Jasa',
    //                 'js_admin' => 'Jasa admin',
    //                 'lain_lain' => 'Lain-lain',
    //                 'barang_kons' => 'Pengajuan unit konsumsi',
    //                 'piutang' => 'Piutang',
    //                 'hutang' => 'Pengajuan pinjaman',
    //             ];

    //             $transaksi = [];
    //             $totalJumlah = 0;

    //             foreach ($fields as $field => $label) {
    //                 if (!empty($item->$field)) {
    //                     if (
    //                         in_array($field, ['wajib', 'wajib_pinjam', 'manasuka', 'qurban']) &&
    //                         $item->jenis_transaksi === 'kas keluar'
    //                     ) {
    //                         $transaksi[] = $label;
    //                         $totalJumlah -= $item->$field;
    //                     } else {
    //                         $transaksi[] = $label;
    //                         $totalJumlah += $item->$field;
    //                     }
    //                 }
    //             }

    //             if (!empty($item->jasa) && !empty($item->angsuran)) {
    //                 $item->transaksi = 'Bayar angsuran pinjaman';
    //             } elseif (!empty($item->jasa) && !empty($item->barang_kons)) {
    //                 $item->transaksi = 'Bayar angsuran unit konsumsi';
    //             } elseif (!empty($item->jasa) && !empty($item->pinjaman_id)) {
    //                 $item->transaksi = 'Bayar jasa pinjaman';
    //             } elseif (!empty($item->jasa) && !empty($item->unit_konsumsi_id)) {
    //                 $item->transaksi = 'Bayar jasa unit konsumsi';
    //             } else {
    //                 $item->transaksi = implode(', ', $transaksi);
    //             }

    //             $item->jumlah = $totalJumlah;
    //             $item->skip_render = false;

    //             return $item;
    //         });

    //     return view('livewire.anggota.riwayat-table', [
    //         'riwayat' => $riwayat
    //     ]);
    // }

    public function render()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        // Ambil riwayat dari KasHarian
        $kasHarian = KasHarian::where('anggota_id', $anggotaId)
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                $excludeFields = [
                    'hari_lembur', 'perjalanan_pengawas', 'thr', 'admin', 'iuran_dekopinda', 'honor_pengurus',
                    'rkrab', 'pembinaan', 'harkop', 'dandik', 'rapat', 'jasa_manasuka',
                    'pajak', 'tabungan_qurban', 'dekopinda', 'wajib_pkpri', 'dansos',
                    'shu', 'dana_pengurus', 'dana_kesejahteraan', 'pembayaran_listrik_dan_air', 'tnh_kav'
                ];

                if ($item->jenis_transaksi === 'kas keluar') {
                    $excludeFields[] = 'lain_lain';
                }

                foreach ($excludeFields as $field) {
                    if (!empty($item->$field)) {
                        $item->skip_render = true;
                        return $item;
                    }
                }

                $fields = [
                    'pokok' => 'Pokok',
                    'wajib' => 'Wajib',
                    'manasuka' => 'Manasuka',
                    'wajib_pinjam' => 'Wajib Pinjam',
                    'qurban' => 'Qurban',
                    'angsuran' => 'Angsuran',
                    'jasa' => 'Jasa',
                    'js_admin' => 'Jasa admin',
                    'lain_lain' => 'Lain-lain',
                    'barang_kons' => 'Pengajuan unit konsumsi',
                    'piutang' => 'Piutang',
                    'hutang' => 'Pengajuan pinjaman',
                ];

                $transaksi = [];
                $totalJumlah = 0;

                foreach ($fields as $field => $label) {
                    if (!empty($item->$field)) {
                        $transaksi[] = $label;
                        $totalJumlah += $item->$field;
                    }
                }

                if ((!empty($item->jasa) && !empty($item->angsuran)) || !empty($item->angsuran)) {
                    $item->transaksi = 'Bayar angsuran pinjaman';
                } elseif ((!empty($item->jasa) && !empty($item->barang_kons)) || (!empty($item->barang_kons) && $item->jenis_transaksi === 'kas masuk')) {
                    $item->transaksi = 'Bayar angsuran unit konsumsi';
                } elseif (!empty($item->jasa) && !empty($item->pinjaman_id)) {
                    $item->transaksi = 'Bayar jasa pinjaman';
                } elseif (!empty($item->jasa) && !empty($item->unit_konsumsi_id)) {
                    $item->transaksi = 'Bayar jasa unit konsumsi';
                } else {
                    $item->transaksi = implode(', ', $transaksi);
                }

                $item->jumlah = $totalJumlah;
                $item->type = 'kas';
                $item->skip_render = false;

                return $item;
            });

        // Ambil riwayat tabungan qurban
        $qurbanRiwayat = RiwayatTabunganQurban::where('anggota_id', $anggotaId)
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                $item->transaksi = 'Penarikan Tabungan Qurban';
                $item->jumlah = $item->jumlah;
                $item->tanggal = $item->tanggal;
                $item->type = 'qurban';
                $item->skip_render = false;
                return $item;
            });

            $riwayatGabungan = $kasHarian->concat($qurbanRiwayat)
            ->sortByDesc('tanggal')
            ->sortByDesc('created_at')
            ->values();

        // Buat pagination manual
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $riwayatGabungan->slice(($page - 1) * $perPage, $perPage)->all();
        $paginatedRiwayat = new LengthAwarePaginator(
            $currentItems,
            $riwayatGabungan->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.anggota.riwayat-table', [
            'riwayat' => $paginatedRiwayat
        ]);
    }
}
