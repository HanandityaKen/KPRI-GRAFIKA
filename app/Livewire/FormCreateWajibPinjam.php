<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WajibPinjam;

/**
 * Komponen Livewire untuk form pembuatan wajib pinjam.
 * 
 * Fitur:
 * - Validasi interaktif untuk setiap field input (nominal)
 * - Penanganan error dan status disable untuk tombol submit
 */
class FormCreateWajibPinjam extends Component
{
    /**
     * Komponen untuk form wajib pinjam.
     *
     * Properti:
     * - $nominal: Inputan dari user untuk nominal wajib pinjam.
     * - $error_nominal: Menyimpan pesan error untuk input nominal.
     * - $disabled: Menandakan apakah tombol submit dalam keadaan disabled.
     */
    public $nominal = '';
    public $disabled = false;
    public $error_nominal = '';

    /**
     * Validasi real-time saat nominal diubah.
     * Mengecek apakah nominal sudah ada di database.
     */
    public function updatedNominal()
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);

        if (WajibPinjam::where('nominal', $nominal)->exists()) {
            $this->error_nominal = '* Nominal sudah ada';
            $this->disabled = true;
            return;
        }

        $this->error_nominal = '';
        $this->disabled = false;
    }

    /**
     * Merender tampilan form
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.form-create-wajib-pinjam');
    }
}
