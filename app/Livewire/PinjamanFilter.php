<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data pinjaman.
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota dari relasi pengajuan pinjaman.
 * - Pencarian berdasarkan status pinjaman.
 *
 * @property string $search Input pencarian pengguna.
 */
class PinjamanFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nama anggota atau status pinjaman.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Mereset halaman ke awal saat pencarian diperbarui.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Merender komponen Livewire dengan data pinjaman yang difilter.
     *
     * - Filter berdasarkan `nama_anggota` dari relasi `pengajuan_pinjaman`.
     * - Atau berdasarkan `status` dari tabel `pinjamans`.
     * - Data diurutkan berdasarkan waktu pembuatan terbaru.
     * - Menampilkan 10 data per halaman.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pinjaman-filter', [
            'pinjamans' => Pinjaman::with('pengajuan_pinjaman')
                ->whereHas('pengajuan_pinjaman', function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%');
                })
                ->orWhere('status', 'like', '%' . $this->search . '%')
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
