<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class PinjamanFilter extends Component
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
        return view('livewire.pinjaman-filter', [
            'pinjamans' => Pinjaman::with('pengajuan_pinjaman.anggota')
                ->whereHas('pengajuan_pinjaman.anggota', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orWhere('status', 'like', '%' . $this->search . '%')
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
