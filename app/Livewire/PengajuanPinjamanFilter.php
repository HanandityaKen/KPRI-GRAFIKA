<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PengajuanPinjaman;
use App\Models\Anggota;
use App\Models\Saldo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data pengajuan pinjaman.
 *
 * Fitur:
 * - Pencarian berdasarkan nama anggota, status pinjaman, atau tanggal pengajuan.
 * - Tanggal dapat difilter dalam format 'd-m-Y' atau 'd-m'.
 *
 * @property string $search Input pencarian dari pengguna
 */
class PengajuanPinjamanFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian dari pengguna (nama anggota, status, atau tanggal).
     *
     * @var string
     */
    public $search = '';
    public $anggotaList = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->anggotaList = Anggota::where('posisi', 'pengurus')->pluck('nama', 'id')->toArray();
    }

    /**
     * Reset halaman pagination ke awal saat pencarian diperbarui.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function setujuiPinjaman($id)
    // {
    //     $pinjaman = PengajuanPinjaman::find($id);

    //     if (!$pinjaman) {
    //         session()->flash('error', 'Pinjaman tidak ditemukan');
    //         return;
    //     }

    //     if ($pinjaman->status !== 'menunggu') {
    //         session()->flash('error', 'Pinjaman sudah diproses');
    //         return;
    //     }

    //     $saldoTerakhir = Saldo::first();

    //     $totalPinjaman = $pinjaman->total_pinjaman;

    //     if ($saldoTerakhir->saldo < $totalPinjaman) {
    //         session()->flash('error', 'Saldo Koperasi tidak cukup');
    //         return;
    //     }

    //     $saldoTerakhir->update([
    //         'saldo' => $saldoTerakhir->saldo - $totalPinjaman
    //     ]);

    //     $pinjaman->update([
    //         'status' => 'disetujui'
    //     ]);

    //     session()->flash('success', 'Pinjaman berhasil disetujui');
    // }

    // public function tolakPinjaman($id)
    // {
    //     $pinjaman = PengajuanPinjaman::find($id);

    //     if ($pinjaman && $pinjaman->status == 'menunggu') {
    //         $pinjaman->update(['status' => 'ditolak']);

    //         session()->flash('error', 'Pinjaman berhasil ditolak');
    //     }
    // }

    /**
     * Render tampilan Livewire dengan data pengajuan pinjaman yang difilter.
     *
     * - Filter berdasarkan nama anggota dan status pinjaman.
     * - Jika pencarian cocok dengan format tanggal, lakukan filter juga berdasarkan tanggal pengajuan.
     * - Menggunakan pagination (10 item per halaman).
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengajuan-pinjaman-filter', [
            'pengajuanPinjamans' => PengajuanPinjaman::where(function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%')
                        ->orWhere('status', 'like', '%' . $this->search . '%');
    
                    // Filter berdasarkan tanggal
                    try {
                        $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                        $query->orWhereDate('tanggal', $date);
                    } catch (\Exception $e) {
                        try {
                            $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                            $query->orWhereRaw("DATE_FORMAT(tanggal, '%m-%d') = ?", [$date]);
                        } catch (\Exception $e) {
                            // Abaikan error parsing tanggal
                        }
                    }
                })
                ->orderByDesc('tanggal')
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
