<?php

namespace App\Livewire\Pengurus;

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

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pengurus.simpanan-filter', [
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

    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "simpanan_anggota_{$tanggal}.xlsx";
    
        return Excel::download(new SimpananExport, $filename);
    }
}
