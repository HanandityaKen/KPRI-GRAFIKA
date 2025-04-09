<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PengajuanPinjaman;
use App\Models\Anggota;
use App\Models\Saldo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

class PinjamanDashboardAdmin extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.pinjaman-dashboard-admin', [
            'pengajuanPinjamans' => PengajuanPinjaman::where('status', 'menunggu') 
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
