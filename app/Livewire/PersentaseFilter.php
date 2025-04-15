<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persentase;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data persentase.
 *
 * Fitur:
 * - Pencarian berdasarkan nama persentase atau nilai persentase.
 * - Reset halaman saat input pencarian diperbarui.
 *
 * @property string $search Input pencarian dari pengguna.
 */
class PersentaseFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nama persentase atau nilai persentase.
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
     * Render data persentase berdasarkan filter pencarian.
     *
     * - Filter berdasarkan nama (field `nama`) dan nilai persentase.
     * - Persentase dikonversi ke format persen dan dicocokkan dengan input pencarian.
     * - Pagination: 10 data per halaman.
     *
     * @return \Illuminate\View\View
     */
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
