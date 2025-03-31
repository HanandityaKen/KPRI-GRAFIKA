<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Angsuran;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Exports\AngsuranPinjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class AngsuranFilter extends Component
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
        return view('livewire.pengurus.angsuran-filter', [
            'angsurans' => Angsuran::with(['pinjaman.pengajuan_pinjaman.anggota'])
                ->where(function ($query) {
                    $query->whereHas('pinjaman.pengajuan_pinjaman.anggota', function ($q) {
                        $q->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('pinjaman', function ($q) {
                        $q->where('status', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }

    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "angsuran_pinjaman_{$tanggal}.xlsx";
    
        return Excel::download(new AngsuranPinjamanExport, $filename);
    }
}
