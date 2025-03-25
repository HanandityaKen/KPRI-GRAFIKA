<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\AngsuranUnitKonsumsi;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class AngsuranUnitKonsumsiFilter extends Component
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
        return view('livewire.pengurus.angsuran-unit-konsumsi-filter', [
            'angsurans' => AngsuranUnitKonsumsi::with(['unit_konsumsi.pengajuan_unit_konsumsi.anggota'])
                ->whereHas('unit_konsumsi.pengajuan_unit_konsumsi', function ($query) {
                    $query->whereHas('anggota', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('nama_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
                })
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
