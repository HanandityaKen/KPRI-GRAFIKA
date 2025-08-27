<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KasHarian;
use App\Models\Shu;

class FormCreateRealisasiKegiatanUsaha extends Component
{
    public $tahun = '';

    public $jasa_dari_anggota = '';
    public $unit_konsumsi = '';
    public $jasa_skpb = '';
    public $jasa_administrasi = '';
    public $shu_kpri = '';
    public $sewa_rumah = '';
    public $jasa_tanah_kopling = '';
    public $jasa_tanah_lain_lain = '';
    public $jumlah_pendapatan = '';

    public $beban_organisasi = '';
    public $beban_operasional = '';
    public $beban_umum = '';
    public $beban_lain_lain = '';
    public $jumlah_beban = '';

    public $shu_sebelum_pajak = '';
    public $pajak = '';
    public $shu = '';

    public $disabledButton = false;
    public $errorMessage;
    
    public $disabledErrorTahun = false;
    public $errorMessageTahun;

    public $disabled = false;

    public function mount() 
    {
        $this->tahun = date('Y');

        $this->cekTahun();
        $this->getBeban();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'tahun') {
            $this->cekTahun();
            $this->getBeban();
        }
    }

    public function cekTahun()
    {
        if ($this->tahun < 2020) {
            $this->errorMessageTahun = '* Tahun tidak boleh kurang dari 2020.';
            $this->disabledErrorTahun = true;
        } elseif (Shu::where('tahun', $this->tahun)->exists()) {
            $this->errorMessageTahun = '* Tahun tersebut sudah tercatat, pilih tahun yang berbeda.';
            $this->disabledErrorTahun = true;
        } else {
            $this->errorMessageTahun = '';
            $this->disabledErrorTahun = false;
        }
        
        $this->checkDisabled();
    }

    // Hitung pendapatan
    public function updatedJasaDariAnggota()
    {
        $this->hitungJumlahPedapatan();
    }

    public function updatedUnitKonsumsi()
    {
        $this->hitungJumlahPedapatan();
    }
    
    public function updatedJasaSkpb()
    {
        $this->hitungJumlahPedapatan();
    }
    
    public function updatedJasaAdministrasi()
    {
        $this->hitungJumlahPedapatan();
    }

    public function updatedShuKpri()
    {
        $this->hitungJumlahPedapatan();
    }

    
    public function updatedSewaRumah()
    {
        $this->hitungJumlahPedapatan();
    }
    
    public function updatedJasaTanahKopling()
    {
        $this->hitungJumlahPedapatan();
    }
    
    public function updatedJasaTanahLainLain()
    {
        $this->hitungJumlahPedapatan();
    }

    public function hitungJumlahPedapatan()
    {
        $jasa_dari_anggota = (int) str_replace(['Rp', '.', ','], '', $this->jasa_dari_anggota);
        $unit_konsumsi = (int) str_replace(['Rp', '.', ','], '', $this->unit_konsumsi);
        $jasa_skpb = (int) str_replace(['Rp', '.', ','], '', $this->jasa_skpb);
        $jasa_administrasi = (int) str_replace(['Rp', '.', ','], '', $this->jasa_administrasi);
        $shu_kpri = (int) str_replace(['Rp', '.', ','], '', $this->shu_kpri);
        $sewa_rumah = (int) str_replace(['Rp', '.', ','], '', $this->sewa_rumah);
        $jasa_tanah_kopling = (int) str_replace(['Rp', '.', ','], '', $this->jasa_tanah_kopling);
        $jasa_tanah_lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->jasa_tanah_lain_lain);

        $jumlah_pendapatan = $jasa_dari_anggota + $unit_konsumsi + $jasa_skpb +
                            $jasa_administrasi + $shu_kpri + $sewa_rumah + $jasa_tanah_kopling +
                            $jasa_tanah_lain_lain;

        $this->jumlah_pendapatan = "Rp " . number_format($jumlah_pendapatan, 0, ',', '.');

        $this->hitungShuSebelumPajak();
    }

    // Hitung beban
    public function getBeban()
    {
        $this->beban_organisasi = (int) (
            KasHarian::whereYear('tanggal', $this->tahun)->sum('rkrab')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('pembinaan')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('harkop')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('dandik')
        );

        $this->beban_operasional = (int) (
            KasHarian::whereYear('tanggal', $this->tahun)->sum('rapat')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('jasa_manasuka')
        );

        $this->beban_umum = (int) (
            KasHarian::whereYear('tanggal', $this->tahun)->sum('hari_lembur')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('perjalanan_pengawas')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('thr')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('admin')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('iuran_dekopinda')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('honor_pengurus')
        );

        $this->beban_lain_lain = (int) (
            KasHarian::whereYear('tanggal', $this->tahun)->sum('pajak')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('tabungan_qurban')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('dekopinda')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('wajib_pkpri')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('dansos')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('shu')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('dana_pengurus')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('dana_kesejahteraan')
            + KasHarian::whereYear('tanggal', $this->tahun)->sum('pembayaran_listrik_dan_air')
        );

        $this->beban_organisasi = "Rp " . number_format($this->beban_organisasi, 0, ',', '.');
        $this->beban_operasional = "Rp " . number_format($this->beban_operasional, 0, ',', '.');
        $this->beban_umum = "Rp " . number_format($this->beban_umum, 0, ',', '.');
        $this->beban_lain_lain = "Rp " . number_format($this->beban_lain_lain, 0, ',', '.');

        $this->hitungBeban();
    }

    public function hitungBeban()
    {
        $beban_organisasi = (int) str_replace(['Rp', '.', ','], '', $this->beban_organisasi);
        $beban_operasional = (int) str_replace(['Rp', '.', ','], '', $this->beban_operasional);
        $beban_umum = (int) str_replace(['Rp', '.', ','], '', $this->beban_umum);
        $beban_lain_lain = (int) str_replace(['Rp', '.', ','], '', $this->beban_lain_lain);

        $this->jumlah_beban = $beban_organisasi + $beban_operasional + $beban_umum + $beban_lain_lain;

        $this->jumlah_beban = "Rp " . number_format($this->jumlah_beban, 0, ',', '.');

        $this->hitungShuSebelumPajak();
    }

    public function updatedBebanOrganisasi() 
    {
        $this->hitungBeban();
    }

    public function updatedBebanOperasional() 
    {
        $this->hitungBeban();
    }

    public function updatedBebanUmum() 
    {
        $this->hitungBeban();
    }

    public function updatedBebanLainLain() 
    {
        $this->hitungBeban();
    }

    // Hitung shu sebelum pajak
    public function hitungShuSebelumPajak()
    {
        $jumlah_pendapatan = (int) str_replace(['Rp', '.', ','], '', $this->jumlah_pendapatan);
        $jumlah_beban = (int) str_replace(['Rp', '.', ','], '', $this->jumlah_beban);

        $shu_sebelum_pajak = $jumlah_pendapatan - $jumlah_beban;

        if ($shu_sebelum_pajak < 0) {
            $this->shu_sebelum_pajak = "Rp " . number_format(0, 0, ',', '.');
            $this->hitungPajak();
            return;
        }

        $this->shu_sebelum_pajak = "Rp " . number_format($shu_sebelum_pajak, 0, ',', '.');

        $this->hitungPajak();
    }

    // Hitung pajak
    public function hitungPajak()
    {
        $shu_sebelum_pajak = (int) str_replace(['Rp', '.', ','], '', $this->shu_sebelum_pajak);

        // SHU sebelum pajak dikali 11%
        $pajak = $shu_sebelum_pajak * (11/100);

        $this->pajak = "Rp " . number_format($pajak, 0, ',', '.');

        $this->hitungShuSetelahPajak();
    }

    // Hitung SHU setelah pajak
    public function hitungShuSetelahPajak()
    {
        $shu_sebelum_pajak = (int) str_replace(['Rp', '.', ','], '', $this->shu_sebelum_pajak);

        $pajak = (int) str_replace(['Rp', '.', ','], '', $this->pajak);

        $shu = $shu_sebelum_pajak - $pajak;

        $this->shu = "Rp " . number_format($shu, 0, ',', '.');

        $this->disableButton();
    }

    // Disabled button simpan jika shu negatif
    public function disableButton()
    {
        $shu = (int) str_replace(['Rp', '.', ','], '', $this->shu);

        if ($shu <= 0) {
            $this->disabledButton = true;
            $this->errorMessage = '* SHU tidak boleh 0 atau negatif!';
        } else {
            $this->disabledButton = false;
            $this->errorMessage = '';
        }

        $this->checkDisabled();
    }

    public function checkDisabled()
    {
        if ($this->disabledErrorTahun || $this->disabledButton) {
            $this->disabled = true;
            return;
        }

        $this->disabled = false;
    }

    public function render()
    {
        return view('livewire.form-create-realisasi-kegiatan-usaha');
    }
}
