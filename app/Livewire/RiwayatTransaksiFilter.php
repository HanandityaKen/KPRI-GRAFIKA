<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

/**
 * Komponen Livewire untuk memfilter dan menampilkan riwayat transaksi kas harian.
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota, jenis transaksi, atau tanggal.
 * - Tanggal dapat difilter dalam format 'd-m-Y' atau 'd-m'.
 *
 * @property string $search Input pencarian dari pengguna
 */
class RiwayatTransaksiFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nama anggota, jenis transaksi, atau tanggal.
     *
     * @var string
     */
    public $search = '';

    /**
     * Tahun yang dipilih untuk filter.
     *
     * @var string
     */
    public $selectedYear;
    
    /**
     * Daftar tahun yang tersedia untuk filter.
     *
     * @var array
     */
    public $availableYears = [];
    
    /**
     * Bulan yang dipilih untuk filter.
     *
     * @var string
     */
    public $selectedMonth;
    
    /**
     * Daftar bulan yang tersedia untuk filter.
     *
     * @var array
     */
    public $availableMonths = [];

    protected $paginationTheme = 'tailwind';

    /**
     * Mereset halaman ke awal saat pencarian diperbarui.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Merender komponen Livewire, mengambil transaksi berdasarkan filter dan kuery pencarian.
     *
     * @return \Illuminate\View\View
     */
    public function mount()
    {
        // $this->selectedYear = now()->format('Y');
        $this->selectedYear = '';
        $years = KasHarian::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        rsort($years);

        $this->availableYears = $years;
        
        $this->updateAvailableMonths();
    }

    /**
     * Memperbarui bulan yang tersedia berdasarkan tahun yang dipilih.
     */
    public function updateAvailableMonths()
    {
        Carbon::setLocale('id');

        $months = KasHarian::whereYear('tanggal', $this->selectedYear)
            ->selectRaw('MONTH(tanggal) as month')
            ->distinct()
            ->orderBy('month', 'asc')
            ->pluck('month')
            ->toArray();

        $this->availableMonths = array_map(function ($month) {
            return [
                'value' => $month,
                'label' => \Carbon\Carbon::createFromFormat('m', $month)->translatedFormat('F')
            ];
        }, $months);

        $this->selectedMonth = null;
    }

    /**
     * Menangani perubahan tahun yang dipilih dan mereset pagination.
     */
    public function updatedSelectedYear()
    {
        $this->resetPage();
        $this->updateAvailableMonths();
    }

    /**
     * Menangani perubahan bulan yang dipilih dan mereset pagination.
     */
    public function updatedSelectedMonth()
    {
        $this->resetPage();
    }

    /**
     * Merender komponen Livewire, mengambil transaksi berdasarkan filter dan kuery pencarian.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $riwayatTransaksis = KasHarian::when($this->selectedYear, function ($query) {
                $query->whereYear('tanggal', $this->selectedYear);
            })
            ->when($this->selectedMonth, function ($query) {
                $query->whereMonth('tanggal', $this->selectedMonth);
            })
            ->where(function ($query) {
                $query->where('nama_anggota', 'like', '%' . $this->search . '%')
                    ->orWhere('jenis_transaksi', 'like', '%' . $this->search . '%')
                    ->orWhere(function ($query) {
                        try {
                            $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', $date);
                        } catch (\Exception $e) {
                            try {
                                $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                                $query->orWhereRaw("DATE_FORMAT(tanggal, '%m-%d') = ?", [$date]);
                            } catch (\Exception $e) {
                                // Skip jika tidak valid
                            }
                        }
                    });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->onEachSide(1);

        foreach ($riwayatTransaksis as $transaksi) {
            $transaksi->total = array_sum([
                $transaksi->pokok ?? 0,
                $transaksi->wajib ?? 0,
                $transaksi->manasuka ?? 0,
                $transaksi->wajib_pinjam ?? 0,
                $transaksi->qurban ?? 0,
                $transaksi->angsuran ?? 0,
                $transaksi->jasa ?? 0,
                $transaksi->js_admin ?? 0,
                $transaksi->lain_lain ?? 0,
                $transaksi->barang_kons ?? 0,
                $transaksi->piutang ?? 0,
                $transaksi->hutang ?? 0,
                $transaksi->hari_lembur ?? 0,
                $transaksi->perjalanan_pengawas ?? 0,
                $transaksi->thr ?? 0,
                $transaksi->admin ?? 0,
                $transaksi->iuran_dekopinda ?? 0,
                $transaksi->honor_pengurus ?? 0,
                $transaksi->rkrab ?? 0,
                $transaksi->pembinaan ?? 0,
                $transaksi->harkop ?? 0,
                $transaksi->dandik ?? 0,
                $transaksi->rapat ?? 0,
                $transaksi->jasa_manasuka ?? 0,
                $transaksi->pajak ?? 0,
                $transaksi->tabungan_qurban ?? 0,
                $transaksi->dekopinda ?? 0,
                $transaksi->wajib_pkpri ?? 0,
                $transaksi->dansos ?? 0,
                $transaksi->shu ?? 0,
                $transaksi->dana_pengurus ?? 0,
                $transaksi->dana_kesejahteraan ?? 0,
                $transaksi->pembayaran_listrik_dan_air ?? 0,
                $transaksi->tnh_kav ?? 0,
            ]);
        }

        return view('livewire.riwayat-transaksi-filter', [
            'riwayatTransaksis' => $riwayatTransaksis,
        ]);
    }


}
