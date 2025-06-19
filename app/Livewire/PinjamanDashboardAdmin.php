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
 * Komponen Livewire untuk menampilkan daftar pengajuan pinjaman
 * dengan status "menunggu" di dashboard admin.
 *
 * Fitur:
 * - Menampilkan daftar pengajuan pinjaman terbaru.
 */
class PinjamanDashboardAdmin extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $anggotaList = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->anggotaList = Anggota::where('posisi', 'pengurus')->pluck('nama', 'id')->toArray();
    }

    /**
     * Render daftar pengajuan pinjaman yang masih berstatus "menunggu".
     *
     * - Menampilkan 10 data per halaman.
     * - Diurutkan dari yang terbaru berdasarkan `created_at`.
     *
     * @return \Illuminate\View\View
     */
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
