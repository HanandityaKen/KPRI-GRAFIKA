<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\KasHarian;
use Carbon\Carbon;
use App\Exports\RekapJkkExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapJkkFilter extends Component
{

    public $selectedYear;

    public $availableYears = [];

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
                SUM(jasa) + 
                SUM(js_admin) + 
                SUM(lain_lain) + 
                SUM(b_umum) + 
                SUM(b_orgns) + 
                SUM(b_oprs) + 
                SUM(b_lain) + 
                SUM(tnh_kav) as total
            ')
            ->value('total');
    }


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
                SUM(jasa) as total_jasa,
                SUM(js_admin) as total_j_admin,
                SUM(lain_lain) as total_lain_lain,
                SUM(piutang) as total_piutang,
                SUM(hutang) as total_hutang,
                SUM(b_umum) as total_b_umum,
                SUM(b_orgns) as total_b_orgns,
                SUM(b_oprs) as total_b_oprs,
                SUM(b_lain) as total_b_lain,
                SUM(tnh_kav) as total_tnh_kav,
                SUM(angsuran + pokok + wajib + manasuka + wajib_pinjam + qurban + jasa + js_admin + lain_lain + b_umum + b_orgns + b_oprs + b_lain + tnh_kav) as total_jumlah
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
                    'total_qurban' => $jkks->get($monthNumber)->total_qurban ?? 0,
                    'total_jasa' => $jkks->get($monthNumber)->total_jasa ?? 0,
                    'total_j_admin' => $jkks->get($monthNumber)->total_j_admin ?? 0,
                    'total_lain_lain' => $jkks->get($monthNumber)->total_lain_lain ?? 0,
                    'total_piutang' => $jkks->get($monthNumber)->total_piutang ?? 0,
                    'total_hutang' => $jkks->get($monthNumber)->total_hutang ?? 0,
                    'total_b_umum' => $jkks->get($monthNumber)->total_b_umum ?? 0,
                    'total_b_orgns' => $jkks->get($monthNumber)->total_b_orgns ?? 0,
                    'total_b_oprs' => $jkks->get($monthNumber)->total_b_oprs ?? 0,
                    'total_tnh_kav' => $jkks->get($monthNumber)->total_tnh_kav ?? 0,
                    'total_jumlah' => $jkks->get($monthNumber)->total_jumlah ?? 0,
                ];
            });

        return view('livewire.pengurus.rekap-jkk-filter', [
            'jkks' => $result,
            'totalPerTahun' => $this->getTotalByYear()
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new RekapJkkExport($this->selectedYear), 'rekap_jkk_'.$this->selectedYear.'.xlsx');
    }
}
