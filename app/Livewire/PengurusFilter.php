<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class PengurusFilter extends Component
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
        return view('livewire.pengurus-filter', [
            'users' => Anggota::where(function($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })
            ->where('posisi', 'pengurus')
            ->paginate(10)
        ]);
    }
}
