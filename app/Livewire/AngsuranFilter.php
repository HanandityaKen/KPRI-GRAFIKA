<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Angsuran;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Exports\AngsuranPinjamanExport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data angsuran pinjaman.
 * 
 * Fitur:
 * - Pencarian berdasarkan nama anggota atau status pinjaman
 * - Paginasi data angsuran 
 * - Relasi eager loading antara angsuran → pinjaman → pengajuan pinjaman
 * - Ekspor data angsuran ke file Excel
 * 
 * @property string $search Kata kunci pencarian untuk memfilter data
 */
class AngsuranFilter extends Component
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
     * - Nama anggota dari relasi pengajuan pinjaman
     * - Status dari tabel pinjaman
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.angsuran-filter', [
            'angsurans' => Angsuran::select('angsuran_pinjaman.*')
                ->join('pinjaman', 'pinjaman.id', '=', 'angsuran_pinjaman.pinjaman_id')
                ->join('pengajuan_pinjaman', 'pengajuan_pinjaman.id', '=', 'pinjaman.pengajuan_pinjaman_id')
                ->where(function ($query) {
                    $query->where('pengajuan_pinjaman.nama_anggota', 'like', '%' . $this->search . '%')
                            ->orWhere('pinjaman.status', 'like', '%' . $this->search . '%');
                })
                ->orderByDesc('pengajuan_pinjaman.tanggal')
                ->orderByDesc('pengajuan_pinjaman.created_at')
                ->with(['pinjaman.pengajuan_pinjaman'])
                ->paginate(10)
                ->onEachSide(1),
        ]);
    }

    /**
     * Mengekspor data angsuran pinjaman ke dalam file Excel (.xlsx).
     * Nama file akan mengikuti format: angsuran_pinjaman_dd-mm-yyyy.xlsx
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "angsuran_pinjaman_{$tanggal}.xlsx";
    
        return Excel::download(new AngsuranPinjamanExport, $filename);
    }
}
