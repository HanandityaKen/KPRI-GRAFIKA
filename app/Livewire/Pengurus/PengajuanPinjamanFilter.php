<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\PengajuanPinjaman;
use App\Models\Anggota;
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

    public function render()
    {
        return view('livewire.pengurus.pengajuan-pinjaman-filter', [
            'pengajuanPinjamans' => PengajuanPinjaman::where(function ($query) {
                    $query->where('nama_anggota', 'like', '%' . $this->search . '%')
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
                            // Abaikan error parsing tanggal
                        }
                    }
                })
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
