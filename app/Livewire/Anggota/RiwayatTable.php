<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\KasHarian;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;


class RiwayatTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $anggotaId = Auth::guard('anggota')->user()->id;

        $riwayat = KasHarian::where('anggota_id', $anggotaId)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->through(function ($item) {
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
                    'b_umum' => 'Biaya Umum',
                    'b_orgns' => 'Biaya Organisasi',
                    'b_oprs' => 'Biaya Operasional',
                    'b_lain' => 'Biaya Lain',
                    'tnh_kav' => 'Tanah Kavling'
                ];

                $transaksi = [];
                $totalJumlah = 0;

                foreach ($fields as $field => $label) {
                    if (!empty($item->$field)) {
                        if (in_array($field, ['wajib', 'wajib_pinjam', 'manasuka', 'qurban']) && $item->jenis_transaksi == 'kas keluar') {
                            $transaksi[] = $label;
                            $totalJumlah -= $item->$field;
                        } else {
                            $transaksi[] = $label;
                            $totalJumlah += $item->$field;
                        }
                    }
                }

                if (!empty($item->jasa) && !empty($item->angsuran)) {
                    $item->transaksi = 'Bayar angsuran pinjaman';
                    $item->jumlah = $totalJumlah;
                } elseif (!empty($item->jasa) && !empty($item->barang_kons)) {
                    $item->transaksi = 'Bayar angsuran unit konsumsi';
                    $item->jumlah = $totalJumlah;
                } elseif (!empty($item->jasa)) {
                    $item->transaksi = 'Bayar jasa';
                    $item->jumlah = $totalJumlah;
                } else {
                    $item->transaksi = implode(', ', $transaksi);
                    $item->jumlah = $totalJumlah;
                }

                return $item;
            });

        return view('livewire.anggota.riwayat-table', [
            'riwayat' => $riwayat
        ]);
    }
}
