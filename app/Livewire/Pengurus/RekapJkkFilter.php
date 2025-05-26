<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\KasHarian;
use Carbon\Carbon;
use App\Exports\RekapJkkExport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Komponen Livewire untuk menampilkan rekapitulasi kas keluar (JKK) berdasarkan tahun.
 *
 * Fitur:
 * - Memilih tahun untuk ditampilkan
 * - Menghitung total kas keluar per bulan
 * - Menghitung total kas keluar per tahun
 * - Mengekspor data ke file Excel
 */
class RekapJkkFilter extends Component
{
    /**
     * Tahun yang dipilih oleh pengguna.
     *
     * @var string
     */
    public $selectedYear;

    /**
     * Daftar tahun yang tersedia untuk dipilih.
     *
     * @var array
     */
    public $availableYears = [];

    /**
     * Inisialisasi komponen saat pertama kali dijalankan.
     * Mengambil semua tahun unik dari transaksi kas keluar dan menetapkan tahun saat ini sebagai default.
     *
     * @return void
     */
    public function mount()
    {
        $this->selectedYear = now()->format('Y');
        $years = KasHarian::where('jenis_transaksi', 'kas keluar')
            ->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

            if (!in_array($this->selectedYear, $years)) {
                $years[] = $this->selectedYear;
            }

            rsort($years);

            $this->availableYears = $years;
    }

    /**
     * Menghitung total kas keluar untuk tahun yang dipilih.
     *
     * @return float|null Total kas keluar atau null jika tidak ada data.
     */
    public function getTotalByYear()
    {
        return KasHarian::where('jenis_transaksi', 'kas keluar')
            ->whereYear('tanggal', $this->selectedYear)
            ->selectRaw('
                SUM(angsuran) + 
                SUM(pokok) + 
                SUM(wajib) + 
                SUM(manasuka) + 
                SUM(wajib_pinjam) + 
                SUM(qurban) + 
                SUM(lain_lain) + 
                SUM(piutang) + 
                SUM(hutang) + 
                SUM(b_umum) + 
                SUM(b_orgns) + 
                SUM(b_oprs) + 
                SUM(b_lain) + 
                SUM(tnh_kav) as total
            ')
            ->value('total');
    }

    /**
     * Merender tampilan Livewire dan menghitung rekap kas keluar per bulan.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        Carbon::setLocale('id'); 

        $jkks = KasHarian::selectRaw('
                MONTH(tanggal) as bulan,
                SUM(angsuran) as total_angsuran,
                SUM(pokok) as total_pokok,
                SUM(wajib) as total_wajib,
                SUM(manasuka) as total_m_suka,
                SUM(wajib_pinjam) as total_swp,
                SUM(qurban) as total_qurban,
                SUM(lain_lain) as total_lain_lain,
                SUM(piutang) as total_piutang,
                SUM(hutang) as total_hutang,
                SUM(b_umum) as total_b_umum,
                SUM(b_orgns) as total_b_orgns,
                SUM(b_oprs) as total_b_oprs,
                SUM(b_lain) as total_b_lain,
                SUM(tnh_kav) as total_tnh_kav,
                SUM(angsuran + pokok + wajib + manasuka + wajib_pinjam + qurban + lain_lain + piutang + hutang + b_umum + b_orgns + b_oprs + b_lain + tnh_kav) as total_jumlah
            ')
            ->where('jenis_transaksi', 'kas keluar')
            ->whereYear('tanggal', $this->selectedYear)
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get()
            ->keyBy('bulan');

            $allMonths = collect([
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ]);
        
            // Gabungkan data dari database dengan bulan yang kosong
            $result = $allMonths->map(function ($monthName, $monthNumber) use ($jkks) {
                return [
                    'bulan' => $monthName,
                    'total_angsuran' => $jkks->get($monthNumber)->total_angsuran ?? 0,
                    'total_pokok' => $jkks->get($monthNumber)->total_pokok ?? 0,
                    'total_wajib' => $jkks->get($monthNumber)->total_wajib ?? 0,
                    'total_m_suka' => $jkks->get($monthNumber)->total_m_suka ?? 0,
                    'total_swp' => $jkks->get($monthNumber)->total_swp ?? 0,
                    'total_qurban' => $jkks->get($monthNumber)->total_qurban ?? 0,0,
                    'total_lain_lain' => $jkks->get($monthNumber)->total_lain_lain ?? 0,
                    'total_piutang' => $jkks->get($monthNumber)->total_piutang ?? 0,
                    'total_hutang' => $jkks->get($monthNumber)->total_hutang ?? 0,
                    'total_b_umum' => $jkks->get($monthNumber)->total_b_umum ?? 0,
                    'total_b_orgns' => $jkks->get($monthNumber)->total_b_orgns ?? 0,
                    'total_b_oprs' => $jkks->get($monthNumber)->total_b_oprs ?? 0,
                    'total_b_lain' => $jkks->get($monthNumber)->total_b_lain ?? 0,
                    'total_tnh_kav' => $jkks->get($monthNumber)->total_tnh_kav ?? 0,
                    'total_jumlah' => $jkks->get($monthNumber)->total_jumlah ?? 0,
                ];
            });

        return view('livewire.pengurus.rekap-jkk-filter', [
            'jkks' => $result,
            'totalPerTahun' => $this->getTotalByYear()
        ]);
    }

    /**
     * Mengekspor data rekapitulasi kas keluar ke dalam file Excel berdasarkan tahun yang dipilih.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel()
    {
        return Excel::download(new RekapJkkExport($this->selectedYear), 'rekap_jkk_'.$this->selectedYear.'.xlsx');
    }
}
