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

    /**
     * Kata kunci pencarian untuk filter data angsuran.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Lifecycle hook saat nilai search berubah.
     * Mengatur ulang pagination ke halaman pertama.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Render komponen dengan data angsuran yang telah difilter dan dipaginasi.
     * 
     * Data yang difilter berdasarkan:
     * - Nama anggota dari relasi pengajuan unit konsumsi
     * - Nama barang dari relasi pengajuan unit konsumsi
     * - Status dari tabel pengajuan unit konsumsi
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.angsuran-unit-konsumsi-filter', [
            'angsurans' => AngsuranUnitKonsumsi::with(['unit_konsumsi.pengajuan_unit_konsumsi.anggota'])
                ->whereHas('unit_konsumsi.pengajuan_unit_konsumsi', function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%')
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
