<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk menampilkan dan memfilter data anggota yang memiliki posisi sebagai 'pengurus'.
 *
 * Fitur:
 * - Pencarian berdasarkan nama, email, atau nomor telepon.
 * - Hanya menampilkan anggota dengan posisi 'pengurus'.
 * - Reset halaman saat input pencarian diperbarui.
 *
 * @property string $search Input pencarian pengguna.
 */
class PengurusFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Input pencarian untuk nama, email, atau telepon anggota.
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
     * Render data anggota dengan posisi 'pengurus' berdasarkan filter pencarian.
     *
     * - Filter berdasarkan: nama, email, atau telepon.
     * - Hanya menampilkan anggota dengan `posisi = 'pengurus'`.
     * - Diurutkan berdasarkan `no_anggota` secara ascending.
     * - Pagination: 10 data per halaman.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pengurus-filter', [
            'users' => Anggota::where(function($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })
            ->where('posisi', 'pengurus')
            ->orderBy('no_anggota', 'asc')
            ->paginate(10)
            ->onEachSide(1)
        ]);
    }
}
