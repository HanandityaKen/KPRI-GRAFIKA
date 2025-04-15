<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Simpanan;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Exports\SimpananExport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data simpanan anggota.
 *
 * Fitur:
 * - Pencarian berdasarkan nomor anggota atau nama anggota
 * - Paginasi data simpanan
 * - Ekspor data simpanan ke file Excel
 *
 * @property string $search Kata kunci pencarian untuk memfilter data
 */
class SimpananFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Kata kunci pencarian untuk filter data simpanan.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Mengupdate halaman pagination saat kuery pencarian diperbarui.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Render komponen dengan data simpanan yang telah difilter dan dipaginasi.
     *
     * Data yang difilter berdasarkan:
     * - Nomor anggota
     * - Nama anggota
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus.simpanan-filter', [
            'simpanans' => Simpanan::query()
                ->where(function ($query) {
                    $query->where('no_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_anggota', 'like', '%' . $this->search . '%');
                })
                ->selectRaw('anggota_id, no_anggota, nama_anggota, SUM(pokok) as total_pokok, SUM(wajib) as total_wajib, SUM(manasuka) as total_manasuka, SUM(wajib_pinjam) as total_wajib_pinjam, SUM(qurban) as total_qurban')
                ->groupBy('anggota_id', 'no_anggota', 'nama_anggota')
                ->orderBy('anggota_id', 'asc')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }

    /**
     * Mengekspor data simpanan anggota ke dalam file Excel (.xlsx).
     * Nama file akan mengikuti format: simpanan_anggota_dd-mm-yyyy.xlsx
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel()
    {
        $tanggal = date('d-m-Y');
        $filename = "simpanan_anggota_{$tanggal}.xlsx";
    
        return Excel::download(new SimpananExport, $filename);
    }
}
