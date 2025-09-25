<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PerhitunganNeraca;

class PerhitunganNeracaFilter extends Component
{
    public function render()
    {
        return view('livewire.perhitungan-neraca-filter', [
            'perhitunganNeracas' => PerhitunganNeraca::orderBy('tahun', 'desc')
                    ->paginate(10)
                    ->onEachSide(1)
        ]);
    }
}
