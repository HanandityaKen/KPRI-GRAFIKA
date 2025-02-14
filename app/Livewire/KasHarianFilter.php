<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Carbon\Carbon;

class KasHarianFilter extends Component
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
        return view('livewire.kas-harian-filter', [
            'kasHarians' => KasHarian::where(function ($query) {
                    $query->whereHas('anggota', function ($query) {
                        $query->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->orWhere('jenis_transaksi', 'like', '%' . $this->search . '%')
                    ->orWhere(function ($query) {
                        try {
                            $date = Carbon::createFromFormat('d-m-Y', $this->search, 'Asia/Jakarta')->format('Y-m-d');
                            $query->where('tanggal', $date);
                        } catch (\Exception $e) {
                            try {
                                $date = Carbon::createFromFormat('d-m', $this->search, 'Asia/Jakarta')->format('m-d');
                                $query->orWhereRaw("DATE_FORMAT(tanggal, '%m-%d') = ?", [$date]);
                            } catch (\Exception $e) {
                                // Skip jika tidak valid
                            }
                        }
                    });
                })
                ->orderByDesc('created_at')
                ->paginate(5)
                ->onEachSide(1)
        ]);        
        
    }
}
