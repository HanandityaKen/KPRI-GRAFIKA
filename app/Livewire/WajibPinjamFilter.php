<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WajibPinjam;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data simpanan wajib pinjam.
 */
class WajibPinjamFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nominal pinjaman.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Mereset halaman ke awal saat pencarian diperbarui.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Merender komponen Livewire dengan data simpanan wajib pinjam yang difilter.
     *
     * - Filter berdasarkan `nominal`.
     * - Data diurutkan berdasarkan waktu pembuatan terbaru.
     * - Menampilkan 10 data per halaman.
     *
     * @return \Illuminate\View\View
     */
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
