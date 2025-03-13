<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use Carbon\Carbon;
use App\Exports\RekapJkmExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapJkmFilter extends Component
{
    public $selectedYear;

    public $availableYears = [];

    public function mount()
    {
        $this->selectedYear = now()->format('Y');
        $years = KasHarian::where('jenis_transaksi', 'kas masuk')
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
        return KasHarian::where('jenis_transaksi', 'kas masuk')
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
                SUM(barang_kons) as total
            ')
            ->value('total');
    }


    public function render()
    {
        Carbon::setLocale('id'); 

        $jkms = KasHarian::selectRaw('
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
                SUM(barang_kons) as total_barang_kons,
                SUM(angsuran + pokok + wajib + manasuka + wajib_pinjam + qurban + jasa + js_admin + lain_lain + barang_kons) as total_jumlah
            ')
            ->where('jenis_transaksi', 'kas masuk')
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
            $result = $allMonths->map(function ($monthName, $monthNumber) use ($jkms) {
                return [
                    'bulan' => $monthName,
                    'total_angsuran' => $jkms->get($monthNumber)->total_angsuran ?? 0,
                    'total_pokok' => $jkms->get($monthNumber)->total_pokok ?? 0,
                    'total_wajib' => $jkms->get($monthNumber)->total_wajib ?? 0,
                    'total_m_suka' => $jkms->get($monthNumber)->total_m_suka ?? 0,
                    'total_swp' => $jkms->get($monthNumber)->total_swp ?? 0,
                    'total_qurban' => $jkms->get($monthNumber)->total_qurban ?? 0,
                    'total_jasa' => $jkms->get($monthNumber)->total_jasa ?? 0,
                    'total_j_admin' => $jkms->get($monthNumber)->total_j_admin ?? 0,
                    'total_lain_lain' => $jkms->get($monthNumber)->total_lain_lain ?? 0,
                    'total_barang_kons' => $jkms->get($monthNumber)->total_barang_kons ?? 0,
                    'total_jumlah' => $jkms->get($monthNumber)->total_jumlah ?? 0,
                ];
            });

        return view('livewire.rekap-jkm-filter', [
            'jkms' => $result,
            'totalPerTahun' => $this->getTotalByYear()
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new RekapJkmExport($this->selectedYear), 'rekap_jkm_'.$this->selectedYear.'.xlsx');
    }
}
