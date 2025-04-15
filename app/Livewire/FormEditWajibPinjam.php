<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\WajibPinjam;

/**
 * Komponen Livewire untuk form edit wajib pinjam.
 * 
 * Fitur:
 * - Validasi interaktif untuk setiap field input (nominal)
 * - Penanganan error dan status disable untuk tombol submit
 */
class FormEditWajibPinjam extends Component
{
    /**
     * Komponen untuk form edit wajib pinjam.
     * 
     * Properti:
     * - $wajibPinjam: Model wajib pinjam yang sedang diedit.
     * - $nominal: Inputan dari user untuk nominal wajib pinjam.
     * - $error_nominal: Menyimpan pesan error untuk input nominal.
     * - $disabled: Menandakan apakah tombol submit dalam keadaan disabled.
     */
    public $wajibPinjam;
    public $nominal;
    public $disabled = false;
    public $error_nominal = '';

    /**
     * Lifecycle hook untuk inisialisasi data awal.
     * 
     * @param int $id ID wajib pinjam yang akan diedit.
     */
    public function mount($id)
    {
        $this->wajibPinjam = WajibPinjam::findOrFail($id);
        $this->nominal = $this->wajibPinjam->nominal;
    }

    /**
     * Validasi real-time saat nominal diubah.
     * Mengecek apakah nominal sudah ada di database.
     */     
    public function updatedNominal()
    {
        $nominal = (int) str_replace(['Rp', '.', ','], '', $this->nominal);

        if (WajibPinjam::where('nominal', $nominal)
            ->where('id', '!=', $this->wajibPinjam->id)
            ->exists()) {
            $this->error_nominal = '* Nominal sudah digunakan';
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
        return view('livewire.form-edit-wajib-pinjam');
    }
}
