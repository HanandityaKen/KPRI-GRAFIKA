<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengaajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UnitKonsumsiFilter extends Component
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
        return view('livewire.pengurus.unit-konsumsi-filter', [
            'unit_konsumsis' => UnitKonsumsi::with('pengajuan_unit_konsumsi')
                ->whereHas('pengajuan_unit_konsumsi', function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_barang', 'like', '%' . $this->search . '%');
                })
                ->orWhere('status', 'like', '%' . $this->search . '%')
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
