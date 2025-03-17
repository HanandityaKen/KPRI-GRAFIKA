<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PengajuanPinjaman;
use App\Models\Anggota;
use App\Models\Saldo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

class PengajuanPinjamanFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

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

    public function render()
    {
        return view('livewire.pengajuan-pinjaman-filter', [
            'pengajuanPinjamans' => PengajuanPinjaman::with('anggota')
                ->where(function ($query) {
                    $query->whereHas('anggota', function ($query) {
                        $query->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('status', 'like', '%' . $this->search . '%');
    
                    // Filter berdasarkan tanggal
                    try {
                        $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                        $query->orWhereDate('created_at', $date);
                    } catch (\Exception $e) {
                        try {
                            $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                            $query->orWhereRaw("DATE_FORMAT(created_at, '%m-%d') = ?", [$date]);
                        } catch (\Exception $e) {

                        }
                    }
                })
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
