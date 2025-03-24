<?php

namespace App\Livewire\Pengurus;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

class PengajuanUnitKonsumsiFilter extends Component
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
        return view('livewire.pengurus.pengajuan-unit-konsumsi-filter', [
            'pengajuanUnitKonsumsis' => PengajuanUnitKonsumsi::with('anggota')
                ->where(function ($query) {
                    $query->whereHas('anggota', function ($query) {
                        $query->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('nama_barang', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
                    try {
                        $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                        $query->orWhereDate('created_at', $date);
                    } catch (\Exception $e) {
                        try {
                            $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                            $query->orWhereRaw("DATE_FORMAT(created_at, '%m-%d') = ?", [$date]);
                        } catch (\Exception $e) {

                        }
                    }
                })
                ->orderByDesc('created_at')
                ->paginate(10)
                ->onEachSide(1)
        ]);
    }
}
