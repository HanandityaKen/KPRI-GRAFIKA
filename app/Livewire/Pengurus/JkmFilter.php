<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\KasHarian;
use Carbon\Carbon;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data kas masuk (JKM).
 * 
 * Fitur:
 * - Pencarian berdasarkan nama anggota atau tanggal (format: d-m-Y atau d-m).
 * - Menampilkan total dari berbagai jenis transaksi kas masuk.
 * - Reaktif terhadap perubahan input pencarian.
 */
class JkmFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nama anggota atau tanggal.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Reset halaman ke pertama saat input pencarian berubah.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Render tampilan dan ambil data kas masuk berdasarkan pencarian dan pagination.
     *
     * - Data difilter berdasarkan nama anggota atau tanggal.
     * - Tanggal bisa dalam format lengkap (d-m-Y) atau hanya tanggal dan bulan (d-m).
     * - Data digrouping berdasarkan nama anggota dan tanggal.
     * - Menampilkan total dari berbagai jenis kas masuk.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        Carbon::setLocale('id'); 

        $jkms = KasHarian::select('kas_harian.nama_anggota', 'kas_harian.tanggal')
            ->selectRaw('SUM(kas_harian.angsuran) as total_angsuran')
            ->selectRaw('SUM(kas_harian.pokok) as total_pokok')
            ->selectRaw('SUM(kas_harian.wajib) as total_wajib')
            ->selectRaw('SUM(kas_harian.manasuka) as total_manasuka')
            ->selectRaw('SUM(kas_harian.wajib_pinjam) as total_swp')
            ->selectRaw('SUM(kas_harian.qurban) as total_qurban')
            ->selectRaw('SUM(kas_harian.jasa) as total_jasa')
            ->selectRaw('SUM(kas_harian.js_admin) as total_j_admin')
            ->selectRaw('SUM(kas_harian.lain_lain) as total_lain_lain')
            ->selectRaw('SUM(kas_harian.barang_kons) as total_barang_kons')
            ->selectRaw('SUM(kas_harian.angsuran + kas_harian.pokok + kas_harian.wajib + kas_harian.manasuka + kas_harian.wajib_pinjam + kas_harian.qurban + kas_harian.jasa + kas_harian.js_admin + kas_harian.lain_lain + kas_harian.barang_kons) as total_jumlah')
            ->where('kas_harian.jenis_transaksi', 'kas masuk')
            ->where(function ($query) {
                $query->where('kas_harian.nama_anggota', 'like', '%' . $this->search . '%');
                try {
                    $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                    $query->orWhere('kas_harian.tanggal', 'like', '%' . $date . '%');
                } catch (\Exception $e) {
                    try {
                        $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                        $query->orWhereRaw("DATE_FORMAT(kas_harian.tanggal, '%m-%d') = ?", [$date]);
                    } catch (\Exception $e) {
                        
                    }
                }
            })
            ->groupBy('kas_harian.nama_anggota', 'kas_harian.tanggal')
            ->orderBy('kas_harian.tanggal', 'desc')
            ->orderBy('kas_harian.nama_anggota', 'asc')
            ->paginate(10);

        return view('livewire.pengurus.jkm-filter', compact('jkms'));
    }
}
