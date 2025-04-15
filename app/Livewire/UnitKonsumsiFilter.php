<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengaajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data unit konsumsi.
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota, nama barang, atau status.
 * - Paginasi data unit konsumsi.
 *
 * @property string $search Kata kunci pencarian untuk memfilter data
 */
class UnitKonsumsiFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pncarian untuk nama anggota, nama barang, atau status.
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Mereset halaman ke awal saat pencarian diperbarui.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Merender komponen Livewire dengan data unit konsumsi yang difilter.
     * 
     * - Filter berdasarkan `nama_anggota` dari relasi `pengajuan_unit_konsumsi`.
     * - Atau berdasarkan `nama_barang` dari relasi `pengajuan_unit_konsumsi`.
     * - Atau berdasarkan `status` dari tabel `unit_konsumsi`.
     * - Data diurutkan berdasarkan waktu pembuatan terbaru.
     * - Menampilkan 10 data per halaman.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.unit-konsumsi-filter', [
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
