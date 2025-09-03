<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shu;

class RealisasiKegiatanUsahaFilter extends Component
{
    public function render()
    {
        return view('livewire.realisasi-kegiatan-usaha-filter', [
            'shus' => Shu::orderBy('tahun', 'desc')
                    ->paginate(10)
                    ->onEachSide(1)
        ]);
    }
}
