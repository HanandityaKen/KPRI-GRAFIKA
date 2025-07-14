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
            'pinjamans' => Pinjaman::select('pinjaman.*')
                ->join('pengajuan_pinjaman', 'pengajuan_pinjaman.id', '=', 'pinjaman.pengajuan_pinjaman_id')
                ->where(function ($query) {
                    $query->where('pengajuan_pinjaman.nama_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('pinjaman.status', 'like', '%' . $this->search . '%');
                })
                ->orderByDesc('pengajuan_pinjaman.tanggal')
                ->with('pengajuan_pinjaman')
                ->paginate(10)
                ->onEachSide(1),
        ]);
    }
}
