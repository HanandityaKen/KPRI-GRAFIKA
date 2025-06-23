<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\KasHarian;
use Carbon\Carbon;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data kas keluar (JKK).
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota atau tanggal (format: d-m-Y atau d-m).
 * - Menampilkan total dari berbagai jenis transaksi kas keluar.
 * - Reaktif terhadap perubahan input pencarian.
 *
 * @property string $search Input pencarian oleh pengguna (nama atau tanggal)
 */
class JkkFilter extends Component
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
     * Render tampilan dan ambil data kas keluar berdasarkan pencarian dan pagination.
     *
     * - Data difilter berdasarkan nama anggota atau tanggal.
     * - Tanggal bisa dalam format lengkap (d-m-Y) atau hanya tanggal dan bulan (d-m).
     * - Data digrouping berdasarkan nama anggota dan tanggal.
     * - Menampilkan total dari berbagai jenis kas keluar.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        Carbon::setLocale('id'); 

        $jkks = KasHarian::select('kas_harian.nama_anggota', 'kas_harian.tanggal')
            ->selectRaw('SUM(kas_harian.angsuran) as total_angsuran')
            ->selectRaw('SUM(kas_harian.pokok) as total_pokok')
            ->selectRaw('SUM(kas_harian.wajib) as total_wajib')
            ->selectRaw('SUM(kas_harian.manasuka) as total_manasuka')
            ->selectRaw('SUM(kas_harian.wajib_pinjam) as total_swp')
            ->selectRaw('SUM(kas_harian.qurban) as total_qurban')
            ->selectRaw('SUM(kas_harian.lain_lain) as total_lain_lain')
            ->selectRaw('SUM(kas_harian.piutang) as total_piutang')
            ->selectRaw('SUM(kas_harian.hutang) as total_hutang')
            ->selectRaw('SUM(kas_harian.hari_lembur) as total_hari_lembur')
            ->selectRaw('SUM(kas_harian.perjalanan_pengawas) as total_perjalanan_pengawas')
            ->selectRaw('SUM(kas_harian.thr) as total_thr')
            ->selectRaw('SUM(kas_harian.admin) as total_admin')
            ->selectRaw('SUM(kas_harian.iuran_dekopinda) as total_iuran_dekopinda')
            ->selectRaw('SUM(kas_harian.rkrab) as total_rkrab')
            ->selectRaw('SUM(kas_harian.pembinaan) as total_pembinaan')
            ->selectRaw('SUM(kas_harian.harkop) as total_harkop')
            ->selectRaw('SUM(kas_harian.dandik) as total_dandik')
            ->selectRaw('SUM(kas_harian.rapat) as total_rapat')
            ->selectRaw('SUM(kas_harian.jasa_manasuka) as total_jasa_manasuka')
            ->selectRaw('SUM(kas_harian.pajak) as total_pajak')
            ->selectRaw('SUM(kas_harian.tabungan_qurban) as total_tabungan_qurban')
            ->selectRaw('SUM(kas_harian.dekopinda) as total_dekopinda')
            ->selectRaw('SUM(kas_harian.wajib_pkpri) as total_wajib_pkpri')
            ->selectRaw('SUM(kas_harian.dansos) as total_dansos')
            ->selectRaw('SUM(kas_harian.shu) as total_shu')
            ->selectRaw('SUM(kas_harian.dana_pengurus) as total_dana_pengurus')
            ->selectRaw('SUM(kas_harian.tnh_kav) as total_tnh_kav')
            ->selectRaw('SUM(kas_harian.angsuran + kas_harian.pokok + kas_harian.wajib + kas_harian.manasuka + kas_harian.wajib_pinjam + kas_harian.qurban + kas_harian.lain_lain + kas_harian.piutang + kas_harian.hutang + kas_harian.hari_lembur + kas_harian.perjalanan_pengawas + kas_harian.thr + kas_harian.admin + kas_harian.iuran_dekopinda + kas_harian.rkrab + kas_harian.pembinaan + kas_harian.harkop + kas_harian.dandik + kas_harian.rapat + kas_harian.jasa_manasuka + kas_harian.pajak + kas_harian.tabungan_qurban + kas_harian.dekopinda + kas_harian.wajib_pkpri + kas_harian.dansos + kas_harian.shu + kas_harian.dana_pengurus + kas_harian.tnh_kav) as total_jumlah')
            ->where('kas_harian.jenis_transaksi', 'kas keluar')
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

        return view('livewire.jkk-filter', compact('jkks'));
    }
}
