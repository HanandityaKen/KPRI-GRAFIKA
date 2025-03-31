<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AngsuranUnitKonsumsi;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Exports\AngsuranUnitKonsumsiExport;
use Maatwebsite\Excel\Facades\Excel;

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
        return view('livewire.angsuran-unit-konsumsi-filter', [
            'angsurans' => AngsuranUnitKonsumsi::with(['unit_konsumsi.pengajuan_unit_konsumsi.anggota'])
                ->whereHas('unit_konsumsi.pengajuan_unit_konsumsi', function ($query) {
                    $query->whereHas('anggota', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('nama_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
                })
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }

    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "angsuran_unit_konsumsi_{$tanggal}.xlsx";
    
        return Excel::download(new AngsuranUnitKonsumsiExport, $filename);
    }
}
