<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use App\Models\KasHarian;

class JasaManasukaPerBulanFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $selectedYear;

    public $availableYears = [];

    public $search = '';

    public function mount()
    {
        $this->availableYears = KasHarian::selectRaw('YEAR(tanggal) as tahun, SUM(manasuka) as total_manasuka')
            ->whereYear('tanggal', '<=', now()->year)
            ->groupBy('tahun')
            ->having('total_manasuka', '>', 0) 
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        $currentYear = now()->format('Y');

        if (in_array($currentYear, $this->availableYears)) {
            $this->selectedYear = $currentYear;
        } else {
            $this->selectedYear = $this->availableYears[0] ?? null;
        }
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
        $this->updateJasaManasukaPerBulan();
    }

    // private function updateJasaManasukaPerBulan()
    // {
    //     // Ambil saldo akhir tahun sebelumnya per anggota
    //     $saldoAwalPerAnggota = KasHarian::whereYear('tanggal', '<=', $this->selectedYear - 1)
    //         ->selectRaw('
    //             anggota_id,
    //             nama_anggota,
    //             SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN manasuka ELSE 0 END) -
    //             SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN manasuka ELSE 0 END) as saldo
    //         ')
    //         ->groupBy('anggota_id', 'nama_anggota')
    //         ->get()
    //         ->keyBy('anggota_id');

    //     // Ambil transaksi per bulan di tahun berjalan
    //     $data = KasHarian::whereYear('tanggal', $this->selectedYear)
    //         ->selectRaw('
    //             anggota_id,
    //             nama_anggota,
    //             MONTH(tanggal) as bulan,
    //             SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN manasuka ELSE 0 END) -
    //             SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN manasuka ELSE 0 END) as transaksi
    //         ')
    //         ->groupBy('anggota_id', 'nama_anggota', 'bulan')
    //         ->orderBy('anggota_id')
    //         ->orderBy('bulan')
    //         ->get()
    //         ->groupBy('anggota_id');

    //     $result = [];

    //     // gabungkan semua anggota (dari saldoAwal & dari transaksi tahun berjalan)
    //     $allAnggotaIds = $saldoAwalPerAnggota->keys()->merge($data->keys())->unique();

    //     foreach ($allAnggotaIds as $anggotaId) {
    //         $nama = $saldoAwalPerAnggota[$anggotaId]->nama_anggota
    //             ?? optional($data[$anggotaId]->first())->nama_anggota
    //             ?? '-';

    //         // saldo awal (per Desember tahun sebelumnya)
    //         $saldo = $saldoAwalPerAnggota[$anggotaId]->saldo ?? 0;

    //         $result[$anggotaId] = [
    //             'nama' => $nama,
    //             'bulan' => array_fill(1, 12, 0),
    //         ];

    //         // Ambil transaksi tahun berjalan (kalau ada)
    //         $rows = $data[$anggotaId] ?? collect();

    //         // Loop 12 bulan penuh
    //         for ($bulan = 1; $bulan <= 12; $bulan++) {
    //             $row = $rows->firstWhere('bulan', $bulan);

    //             if ($row) {
    //                 $saldo += $row->transaksi;
    //             }

    //             // jasa bulan ini pakai saldo terakhir
    //             $result[$anggotaId]['bulan'][$bulan] = $saldo * 0.005;
    //         }
    //     }
    //     ksort($result);

    //     return $result;
    // }

    public function updatingSearch()
    {
        $this->resetPage();
        $this->updateJasaManasukaPerBulan();
    }

    private function updateJasaManasukaPerBulan()
    {
        // Ambil saldo akhir tahun sebelumnya per anggota
        $saldoAwalPerAnggota = KasHarian::whereYear('tanggal', '<=', $this->selectedYear - 1)
            ->selectRaw('
                anggota_id,
                nama_anggota,
                SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN manasuka ELSE 0 END) -
                SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN manasuka ELSE 0 END) as saldo
            ')
            ->groupBy('anggota_id', 'nama_anggota')
            ->get()
            ->keyBy('anggota_id');

        // Ambil transaksi per bulan di tahun berjalan
        $data = KasHarian::whereYear('tanggal', $this->selectedYear)
            ->selectRaw('
                anggota_id,
                nama_anggota,
                MONTH(tanggal) as bulan,
                SUM(CASE WHEN jenis_transaksi = "kas masuk" THEN manasuka ELSE 0 END) -
                SUM(CASE WHEN jenis_transaksi = "kas keluar" THEN manasuka ELSE 0 END) as transaksi
            ')
            ->groupBy('anggota_id', 'nama_anggota', 'bulan')
            ->orderBy('anggota_id')
            ->orderBy('bulan')
            ->get()
            ->groupBy('anggota_id');

        $result = [];

        // ambil bulan maksimal: kalau tahun terpilih == tahun sekarang, pakai bulan sekarang, kalau bukan, tetap 12
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $maxBulan = ($this->selectedYear == $currentYear) ? $currentMonth : 12;

        // gabungkan semua anggota (dari saldoAwal & dari transaksi tahun berjalan)
        $allAnggotaIds = $saldoAwalPerAnggota->keys()->merge($data->keys())->unique();

        foreach ($allAnggotaIds as $anggotaId) {
            $nama = $saldoAwalPerAnggota[$anggotaId]->nama_anggota
                ?? optional($data[$anggotaId]->first())->nama_anggota
                ?? '-';
            
            // filter nama anggota
            if (!empty($this->search) && !Str::contains(
                    strtolower($nama),         // nama anggota dijadikan lowercase
                    strtolower($this->search) // keyword pencarian dijadikan lowercase
                )) {
                continue; // skip anggota yang tidak cocok
            }

            // saldo awal (per Desember tahun sebelumnya)
            $saldo = $saldoAwalPerAnggota[$anggotaId]->saldo ?? 0;

            $result[$anggotaId] = [
                'nama' => $nama,
                'bulan' => array_fill(1, 12, 0),
            ];

            // Ambil transaksi tahun berjalan (kalau ada)
            $rows = $data[$anggotaId] ?? collect();

            // Loop sampai bulan maksimal
            for ($bulan = 1; $bulan <= $maxBulan; $bulan++) {
                $row = $rows->firstWhere('bulan', $bulan);

                if ($row) {
                    $saldo += $row->transaksi;
                }

                // jasa bulan ini pakai saldo terakhir
                $result[$anggotaId]['bulan'][$bulan] = $saldo * 0.005;
            }
        }

        ksort($result);

        return $result;
    }

    public function render()
    {
        // Bungkus hasil array dengan menggunakan collect
        $collection = collect($this->updateJasaManasukaPerBulan());
        $page = Paginator::resolveCurrentPage('page');
        $perPage = 20;

        $paginated = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('livewire.jasa-manasuka-per-bulan-filter', [
            'result' => $paginated,
        ]);
    }
}
