<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Simpanan;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

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
            'simpanans' => Simpanan::with('anggota', 'kas_harian') 
                ->whereHas('anggota', function ($query) {
                    $query->where('no_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('nama', 'like', '%' . $this->search . '%');
                })
                ->selectRaw('anggota_id, SUM(pokok) as total_pokok, SUM(wajib) as total_wajib, SUM(manasuka) as total_manasuka, SUM(wajib_pinjam) as total_wp, SUM(qurban) as total_qurban')
                ->groupBy('anggota_id')
                ->orderBy(Anggota::select('no_anggota')->whereColumn('anggota.id', 'simpanan.anggota_id'))
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
