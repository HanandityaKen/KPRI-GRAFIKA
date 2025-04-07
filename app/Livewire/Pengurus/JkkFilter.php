<?php

namespace App\Livewire\Pengurus;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\KasHarian;
use Carbon\Carbon;

use Livewire\Component;

class JkkFilter extends Component
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
        Carbon::setLocale('id'); 

        $jkks = KasHarian::select('kas_harian.nama_anggota', 'kas_harian.tanggal')
            ->selectRaw('SUM(kas_harian.angsuran) as total_angsuran')
            ->selectRaw('SUM(kas_harian.pokok) as total_pokok')
            ->selectRaw('SUM(kas_harian.wajib) as total_wajib')
            ->selectRaw('SUM(kas_harian.manasuka) as total_manasuka')
            ->selectRaw('SUM(kas_harian.wajib_pinjam) as total_swp')
            ->selectRaw('SUM(kas_harian.qurban) as total_qurban')
            ->selectRaw('SUM(kas_harian.lain_lain) as total_lain_lain')
            ->selectRaw('SUM(kas_harian.piutang) as total_piutang')
            ->selectRaw('SUM(kas_harian.hutang) as total_hutang')
            ->selectRaw('SUM(kas_harian.b_umum) as total_b_umum')
            ->selectRaw('SUM(kas_harian.b_orgns) as total_b_orgns')
            ->selectRaw('SUM(kas_harian.b_oprs) as total_b_oprs')
            ->selectRaw('SUM(kas_harian.b_lain) as total_b_lain')
            ->selectRaw('SUM(kas_harian.tnh_kav) as total_tnh_kav')
            ->selectRaw('SUM(kas_harian.angsuran + kas_harian.pokok + kas_harian.wajib + kas_harian.manasuka + kas_harian.wajib_pinjam + kas_harian.qurban +  kas_harian.lain_lain + kas_harian.piutang + kas_harian.hutang + kas_harian.b_umum + kas_harian.b_orgns + kas_harian.b_oprs + kas_harian.b_lain + kas_harian.tnh_kav) as total_jumlah')
            ->where('kas_harian.jenis_transaksi', 'kas keluar')
            ->where(function ($query) {
                $query->where('kas_harian.nama_anggota', 'like', '%' . $this->search . '%');
                try {
                    $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                    $query->orWhere('kas_harian.tanggal', 'like', '%' . $date . '%');
                } catch (\Exception $e) {
                    try {
                        $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                        $query->orWhereRaw("DATE_FORMAT(kas_harian.tanggal, '%m-%d') = ?", [$date]);
                    } catch (\Exception $e) {
                        
                    }
                }
            })
            ->groupBy('kas_harian.nama_anggota', 'kas_harian.tanggal')
            ->orderBy('kas_harian.tanggal', 'desc')
            ->orderBy('kas_harian.nama_anggota', 'asc')
            ->paginate(10);

        return view('livewire.pengurus.jkk-filter', compact('jkks'));
    }
}
