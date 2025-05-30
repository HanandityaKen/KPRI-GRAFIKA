<?php

namespace App\Livewire\Pengurus;
use App\Models\Angsuran;

use Livewire\Component;

class FormBayarAngsuran extends Component
{
    public $angsuran;
    public $angsuranManual = '';
    public $error_angsuran_manual;
    public $disabled = false;

    public function mount($id)
    {
        $this->angsuran = Angsuran::findOrFail($id);
    }

    public function updatedAngsuranManual()
    {
        $angsuranManual = (int) str_replace(['Rp', '.', ','], '', $this->angsuranManual);
        $kurangAngsuran = Angsuran::where('id', $this->angsuran->id)->value('kurang_angsuran');
        $tunggakan = Angsuran::where('id', $this->angsuran->id)->value('tunggakan');

        // dd($angsuranManual, $kurangAngsuran, $tunggakan);

        if ($angsuranManual > $kurangAngsuran + $tunggakan) {
            $this->error_angsuran_manual = '* Angsuran manual tidak boleh lebih besar dari kurang angsuran! (Maks: Rp ' . number_format($kurangAngsuran + $tunggakan, 0, ',', '.') . ')';
            $this->disabled = true;
        } else {
            $this->error_angsuran_manual = '';
            $this->disabled = false;
        }
    }

    public function render()
    {
        return view('livewire.pengurus.form-bayar-angsuran');
    }
}
