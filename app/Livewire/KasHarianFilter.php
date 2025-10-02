<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data kas harian.
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota, jenis transaksi, atau tanggal.
 * - Tanggal bisa difilter dalam format 'd-m-Y' atau 'd-m'.
 *
 * @property string $search Input pencarian dari pengguna
 */
class KasHarianFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nama anggota, jenis transaksi, atau tanggal.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Reset halaman ke 1 saat input pencarian diperbarui.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Render tampilan dan ambil data kas harian berdasarkan input pencarian.
     *
     * - Filter berdasarkan nama anggota atau jenis transaksi.
     * - Jika input cocok dengan format tanggal (d-m-Y atau d-m), maka filter juga berdasarkan tanggal.
     * - Gunakan pagination 10 item per halaman,
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.kas-harian-filter', [
            'kasHarians' => KasHarian::where(function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%')
                    ->orWhere('jenis_transaksi', 'like', '%' . $this->search . '%')
                    ->orWhere(function ($query) {
                        try {
                            $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', $date);
                        } catch (\Exception $e) {
                            try {
                                $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                                $query->orWhereRaw("DATE_FORMAT(tanggal, '%m-%d') = ?", [$date]);
                            } catch (\Exception $e) {
                                // Skip jika tidak valid
                            }
                        }
                    });
                })
                ->orderByDesc('tanggal')
                ->orderByDesc('created_at')
                ->paginate(20)
                ->onEachSide(1)
        ]);        
        
    }
}
