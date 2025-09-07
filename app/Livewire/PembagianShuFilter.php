<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Shu;
use App\Models\KasHarian;
use App\Models\Anggota;

class PembagianShuFilter extends Component
{   
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    public $selectedYear;

    public $availableYears = [];

    public $simpanan = 0;
    public $partisipasi = 0;
    public $jumlah = 0;

    public $hasil = [];

    public function mount()
    {
        $this->availableYears = Shu::select('tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun')
        ->toArray();

        $currentYear = now()->format('Y');

        if (in_array($currentYear, $this->availableYears)) {
            $this->selectedYear = $currentYear;
        } else {
            $this->selectedYear = $this->availableYears[0] ?? null;
        }

        $this->updateShu();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
        $this->updateShu();
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->updateShu();
    }

    private function updateShu()
    {
        if (!$this->selectedYear) return collect();

        $shu = Shu::where('tahun', $this->selectedYear)->first();
        if (!$shu) return collect();

        $jumlahShu = $shu->jumlah_shu;
        $jasaPartisipasi = $jumlahShu * 0.2; // 20% untuk partisipasi
        $jasaSimpanan = $jumlahShu * 0.25;   // 25% untuk simpanan

        // Ambil simpanan dan jasa per anggota sekaligus
        $anggotaData = KasHarian::selectRaw('
            anggota_id,
            nama_anggota,
            SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN (pokok + wajib + wajib_pinjam) ELSE 0 END) -
            SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN (pokok + wajib + wajib_pinjam) ELSE 0 END) as total_simpanan,
            SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN jasa ELSE 0 END) as total_jasa
        ')
        ->whereYear('tanggal', $this->selectedYear)
        ->groupBy('anggota_id', 'nama_anggota')
        ->get();

        $totalSimpanan = $anggotaData->sum('total_simpanan');
        $totalJasa = $anggotaData->sum('total_jasa');

        // Hitung proporsi simpanan, partisipasi, dan total SHU
        $result = $anggotaData->map(function($item) use ($totalSimpanan, $totalJasa, $jasaSimpanan, $jasaPartisipasi) {
            $item->partisipasi = $totalJasa > 0
                ? ($item->total_jasa / $totalJasa) * $jasaPartisipasi
                : 0;

            $item->simpanan = $totalSimpanan > 0
                ? ($item->total_simpanan / $totalSimpanan) * $jasaSimpanan
                : 0;

            $item->jumlah = $item->partisipasi + $item->simpanan;

            return $item;
        });

        // Filter Search
        if ($this->search) {
            $result = $result->filter(function ($item) {
                return stripos($item->nama_anggota, $this->search) !== false;
            });
        }
    
        return $result;
    }

    public function render()
    {
        $collection = $this->updateShu();
        $page = Paginator::resolveCurrentPage('page');
        $perPage = 20;

        $paginated = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('livewire.pembagian-shu-filter', [
            'paginatedHasil' => $paginated
        ]);
    }

    // private function updateShu()
    // {
    //     if (!$this->selectedYear) return collect();

    //     $shu = Shu::where('tahun', $this->selectedYear)->first();
    //     if (!$shu) return collect();

    //     $jumlahShu = $shu->jumlah_shu;
    //     $jasaPartisipasi = $jumlahShu * 0.2;
    //     $jasaSimpanan = $jumlahShu * 0.25;

    //     $jasaAnggotaPertahun = KasHarian::with('anggota')
    //         ->whereHas('anggota')
    //         ->where('jenis_transaksi', 'kas masuk')
    //         ->whereYear('tanggal', $this->selectedYear)
    //         ->selectRaw('anggota_id, SUM(jasa) as total_jasa')
    //         ->groupBy('anggota_id')
    //         ->get();

    //     $totalJasaSemuaAnggota = KasHarian::where('jenis_transaksi', 'kas masuk')
    //         ->whereYear('tanggal', $this->selectedYear)
    //         ->sum('jasa');

    //     $simpananAnggotaPertahun = KasHarian::whereYear('tanggal', $this->selectedYear)
    //         ->selectRaw('
    //             anggota_id,
    //             SUM(
    //                 CASE WHEN jenis_transaksi = "kas masuk" 
    //                 THEN (pokok + wajib + wajib_pinjam) ELSE 0 END
    //             ) -
    //             SUM(
    //                 CASE WHEN jenis_transaksi = "kas keluar" 
    //                 THEN (pokok + wajib + wajib_pinjam) ELSE 0 END
    //             ) as total_simpanan
    //         ')
    //         ->groupBy('anggota_id')
    //         ->get();

    //     $totalSimpananSemuaAnggota = KasHarian::whereYear('tanggal', $this->selectedYear)
    //         ->selectRaw('
    //             SUM(
    //                 CASE WHEN jenis_transaksi = "kas masuk" 
    //                 THEN (pokok + wajib + wajib_pinjam) ELSE 0 END
    //             ) -
    //             SUM(
    //                 CASE WHEN jenis_transaksi = "kas keluar" 
    //                 THEN (pokok + wajib + wajib_pinjam) ELSE 0 END
    //             ) as total_simpanan
    //         ')
    //         ->value('total_simpanan');

    //     return $jasaAnggotaPertahun
    //         ->filter(fn($item) => $simpananAnggotaPertahun->firstWhere('anggota_id', $item->anggota_id))
    //         ->map(function($item) use ($totalJasaSemuaAnggota, $jasaPartisipasi, $simpananAnggotaPertahun, $totalSimpananSemuaAnggota, $jasaSimpanan) {
    //             $simpananItem = $simpananAnggotaPertahun->firstWhere('anggota_id', $item->anggota_id);
    //             $item->partisipasi = $totalJasaSemuaAnggota > 0
    //                 ? ($item->total_jasa / $totalJasaSemuaAnggota) * $jasaPartisipasi
    //                 : 0;
    //             $item->simpanan = ($simpananItem && $totalSimpananSemuaAnggota > 0)
    //                 ? ($simpananItem->total_simpanan / $totalSimpananSemuaAnggota) * $jasaSimpanan
    //                 : 0;
    //             $item->jumlah = $item->partisipasi + $item->simpanan;
    //             return $item;
    //         });
    // }

    // public function render()
    // {
    //     $collection = $this->updateShu();
    //     $page = Paginator::resolveCurrentPage('page');
    //     $perPage = 20;
    
    //     $paginated = new LengthAwarePaginator(
    //         $collection->forPage($page, $perPage),
    //         $collection->count(),
    //         $perPage,
    //         $page,
    //         ['path' => Paginator::resolveCurrentPath()]
    //     );
    
    //     return view('livewire.pembagian-shu-filter', [
    //         'paginatedHasil' => $paginated
    //     ]);
    // }
}
