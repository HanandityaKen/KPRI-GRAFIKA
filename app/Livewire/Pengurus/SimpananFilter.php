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
