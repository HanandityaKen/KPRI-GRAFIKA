<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wajib;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class WajibFilter extends Component
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
        return view('livewire.wajib-filter', [
            'wajibs' => Wajib::where(function($query) {
                $query->where('jenis_pegawai', 'like', '%' . $this->search . '%');
            })
            ->paginate(10)
            ->onEachSide(1)
        ]);
    }
}
