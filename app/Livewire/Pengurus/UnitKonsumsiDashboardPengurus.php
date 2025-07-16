<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UnitKonsumsiDashboardPengurus extends Component
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
        return view('livewire.pengurus.unit-konsumsi-dashboard-pengurus', [
            'pengajuanUnitKonsumsis' => PengajuanUnitKonsumsi::where('status', 'menunggu') 
                ->orderByDesc('tanggal')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
