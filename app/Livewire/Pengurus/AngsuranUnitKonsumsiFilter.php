<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\AngsuranUnitKonsumsi;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Exports\AngsuranUnitKonsumsiExport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data angsuran unit konsumsi.
 * 
 * Fitur:
 * - Pencarian berdasarkan nama anggota, nama barang, atau status
 * - Paginasi data angsuran 
 * - Relasi eager loading antara angsuran → unit konsumsi → pengajuan unit konsumsi
 * - Ekspor data angsuran ke file Excel
 * 
 * @property string $search Kata kunci pencarian untuk memfilter data
 */
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
            'angsurans' => AngsuranUnitKonsumsi::select('angsuran_unit_konsumsi.*')
                ->join('unit_konsumsi', 'unit_konsumsi.id', '=', 'angsuran_unit_konsumsi.unit_konsumsi_id')
                ->join('pengajuan_unit_konsumsi', 'pengajuan_unit_konsumsi.id', '=', 'unit_konsumsi.pengajuan_unit_konsumsi_id')
                ->where(function ($query) {
                    $query->where('pengajuan_unit_konsumsi.nama_anggota', 'like', '%' . $this->search . '%')
                            ->orWhere('pengajuan_unit_konsumsi.nama_barang', 'like', '%' . $this->search . '%')
                            ->orWhere('unit_konsumsi.status', 'like', '%' . $this->search . '%');
                })
                ->orderByDesc('pengajuan_unit_konsumsi.tanggal')
                ->with(['unit_konsumsi.pengajuan_unit_konsumsi'])
                ->paginate(10)
                ->onEachSide(1),
        ]);
    }

    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "angsuran_unit_konsumsi_{$tanggal}.xlsx";
    
        return Excel::download(new AngsuranUnitKonsumsiExport, $filename);
    }
}
