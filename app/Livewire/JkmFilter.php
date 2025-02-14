<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\KasHarian;
use Carbon\Carbon;

class JkmFilter extends Component
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

        $jkms = KasHarian::select('anggota.nama', 'kas_harian.tanggal')
            ->selectRaw('SUM(kas_harian.angsuran) as total_angsuran')
            ->selectRaw('SUM(kas_harian.pokok) as total_pokok')
            ->selectRaw('SUM(kas_harian.wajib) as total_wajib')
            ->selectRaw('SUM(kas_harian.manasuka) as total_m_suka')
            ->selectRaw('SUM(kas_harian.wajib_pinjam) as total_swp')
            ->selectRaw('SUM(kas_harian.qurban) as total_qurban')
            ->selectRaw('SUM(kas_harian.jasa) as total_jasa')
            ->selectRaw('SUM(kas_harian.js_admin) as total_j_admin')
            ->selectRaw('SUM(kas_harian.lain_lain) as total_lain_lain')
            ->selectRaw('SUM(kas_harian.barang_kons) as total_barang_kons')
            ->selectRaw('SUM(kas_harian.angsuran + kas_harian.pokok + kas_harian.wajib + kas_harian.manasuka + kas_harian.wajib_pinjam + kas_harian.qurban + kas_harian.jasa + kas_harian.js_admin + kas_harian.lain_lain + kas_harian.barang_kons) as total_jumlah')
            ->join('anggota', 'kas_harian.anggota_id', '=', 'anggota.id')
            ->where('kas_harian.jenis_transaksi', 'kas masuk')
            ->where(function ($query) {
                $query->where('anggota.nama', 'like', '%' . $this->search . '%');
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
            ->groupBy('anggota.nama', 'kas_harian.tanggal')
            ->orderBy('kas_harian.tanggal', 'desc')
            ->orderBy('anggota.nama', 'asc')
            ->paginate(10);

        return view('livewire.jkm-filter', compact('jkms'));
    }
}
