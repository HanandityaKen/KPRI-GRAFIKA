<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data pengajuan unit konsumsi.
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota, nama barang, status pengajuan, atau tanggal pengajuan.
 * - Mendukung format pencarian tanggal: 'd-m-Y' dan 'd-m'.
 * - Reset halaman saat input pencarian berubah.
 *
 * @property string $search Input pencarian dari pengguna.
 */
class PengajuanUnitKonsumsiFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian pengguna, bisa berupa nama, status, atau tanggal.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Mereset halaman ke halaman pertama saat pencarian diperbarui.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Render data pengajuan unit konsumsi berdasarkan filter pencarian.
     *
     * - Filter berdasarkan: nama_anggota, nama_barang, status, dan tanggal (d-m-Y atau d-m).
     * - Ditampilkan secara descending berdasarkan tanggal pembuatan.
     * - Pagination: 10 data per halaman.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus.pengajuan-unit-konsumsi-filter', [
            'pengajuanUnitKonsumsis' => PengajuanUnitKonsumsi::where(function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('nama_barang', 'like', '%' . $this->search . '%')
                        ->orWhere('status', 'like', '%' . $this->search . '%');
                    try {
                        $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                        $query->orWhereDate('tanggal', $date);
                    } catch (\Exception $e) {
                        try {
                            $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                            $query->orWhereRaw("DATE_FORMAT(tanggal, '%m-%d') = ?", [$date]);
                        } catch (\Exception $e) {

                        }
                    }
                })
                ->orderByDesc('tanggal')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
