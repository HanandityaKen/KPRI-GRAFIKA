<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

/**
 * Komponen Livewire untuk memfilter dan menampilkan data anggota dengan fitur pencarian dan paginasi.
 * 
 * Komponen ini memungkinkan pengguna untuk mencari anggota berdasarkan:
 * - Nama
 * - Jenis pegawai
 * - Email
 * - Nomor telepon
 * 
 * Fitur:
 * - Pencarian real-time (menggunakan `updatingSearch` untuk reset halaman saat search berubah)
 * - Paginasi 10 data per halaman
 * - Tidak menyimpan state pagination di URL (menggunakan WithoutUrlPagination)
 * 
 * @property string $search Kata kunci untuk pencarian anggota
 */
class AnggotaFilter extends Component
{
    use WithPagination, WithoutUrlPagination;

    /**
     * Kata kunci pencarian untuk filter data anggota.
     *
     * @var string
     */
    public $search = '';

    protected $paginationTheme = 'tailwind';

    /**
     * Lifecycle hook saat nilai search berubah.
     * Mengatur ulang pagination ke halaman pertama.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Render tampilan komponen dengan data anggota yang difilter.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.anggota-filter', [
            'users' => Anggota::where(function($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('jenis_pegawai', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })
            ->orderBy('no_anggota', 'asc')
            ->paginate(10)
            ->onEachSide(1)
        ]);
    }
}
