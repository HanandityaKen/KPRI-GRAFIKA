<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Wajib;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data simpanan wajib berdasarkan jenis pegawai.
 */
class WajibFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk jenis pegawai.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Merender komponen Livewire dengan data simpanan wajib yang difilter.
     *
     * - Filter berdasarkan `jenis_pegawai`.
     * - Data diurutkan berdasarkan waktu pembuatan terbaru.
     * - Menampilkan 10 data per halaman.
     *
     * @return \Illuminate\View\View
     */
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
