<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UnitKonsumsiDashboardAdmin extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        return view('livewire.unit-konsumsi-dashboard-admin', [
            'pengajuanUnitKonsumsis' => PengajuanUnitKonsumsi::where('status', 'menunggu') 
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
