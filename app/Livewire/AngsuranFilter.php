<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Angsuran;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class AngsuranFilter extends Component
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
        return view('livewire.angsuran-filter', [
            'angsurans' => Angsuran::with(['pinjaman.pengajuan_pinjaman.anggota'])
                ->whereHas('pinjaman.pengajuan_pinjaman.anggota', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
