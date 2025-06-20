<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk menampilkan daftar pengajuan unit konsumsi
 * dengan status "menunggu" di dashboard admin.
 *
 * Fitur:
 * - Menampilkan daftar pengajuan unit konsumsi terbaru.
 */
class UnitKonsumsiDashboardAdmin extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $anggotaList = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->anggotaList = Anggota::where('posisi', 'pengurus')->pluck('nama', 'id')->toArray();
    }

    /**
     * Render daftar pengajuan unit konsumsi yang masih berstatus "menunggu".
     *
     * - Menampilkan 10 data per halaman.
     * - Diurutkan dari yang terbaru berdasarkan `created_at`.
     *
     * @return \Illuminate\View\View
     */
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
