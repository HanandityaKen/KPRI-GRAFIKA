<?php

namespace App\Livewire\Pengurus;

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
        return view('livewire.pengurus.angsuran-filter', [
            'angsurans' => Angsuran::with(['pinjaman.pengajuan_pinjaman.anggota'])
                ->whereHas('pinjaman.pengajuan_pinjaman.anggota', function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
