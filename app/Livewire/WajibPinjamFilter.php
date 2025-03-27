<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WajibPinjam;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class WajibPinjamFilter extends Component
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
        return view('livewire.wajib-pinjam-filter', [
            'wajib_pinjams' => WajibPinjam::where(function($query) {
                $query->where('nominal', 'like', '%' . $this->search . '%');
            })
            ->paginate(10)
            ->onEachSide(1)
        ]);
    }
}
