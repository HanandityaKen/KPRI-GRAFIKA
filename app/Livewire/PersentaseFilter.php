<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persentase;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class PersentaseFilter extends Component
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
        return view('livewire.persentase-filter', [
            'persentases' => Persentase::where(function($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhereRaw("TRIM(TRAILING '.0' FROM FORMAT(persentase * 100, 2)) LIKE ?", ["%{$this->search}%"]);
            })
            ->paginate(10)
            ->onEachSide(1)
        ]);
    }
}
