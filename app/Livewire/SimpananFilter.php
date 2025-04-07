<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Simpanan;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Exports\SimpananExport;
use Maatwebsite\Excel\Facades\Excel;

class SimpananFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    // public $selectedYear;

    // public $availableYears = [];

    // public function mount()
    // {
    //     $this->availableYears = Simpanan::with('kas_harian') // Menggunakan relasi
    //         ->whereHas('kas_harian', function ($query) {
    //             $query->selectRaw('YEAR(tanggal) as year');
    //         })
    //         ->selectRaw('YEAR(kas_harian.tanggal) as year')
    //         ->join('kas_harian', 'simpanan.kas_harian_id', '=', 'kas_harian.id')
    //         ->distinct()
    //         ->orderBy('year', 'desc')
    //         ->pluck('year')
    //         ->toArray();

    //     $this->selectedYear = now()->format('Y');
    // }

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.simpanan-filter', [
            'simpanans' => Simpanan::query()
                ->where(function ($query) {
                    $query->where('no_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_anggota', 'like', '%' . $this->search . '%');
                })
                ->selectRaw('anggota_id, no_anggota, nama_anggota, SUM(pokok) as total_pokok, SUM(wajib) as total_wajib, SUM(manasuka) as total_manasuka, SUM(wajib_pinjam) as total_wp, SUM(qurban) as total_qurban')
                ->groupBy('anggota_id', 'no_anggota', 'nama_anggota')
                ->orderBy('anggota_id', 'asc')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }

    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "simpanan_anggota_{$tanggal}.xlsx";
    
        return Excel::download(new SimpananExport, $filename);
    }
}
