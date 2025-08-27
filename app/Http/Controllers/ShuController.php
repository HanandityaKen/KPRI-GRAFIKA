<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shu;

class ShuController extends Controller
{
    public function indexRealisasiKegiatanUsaha() 
    {
        return view('admin.shu.index-realisasi-kegiatan-usaha');
    }

    public function createRealisasiKegiatanUsaha() 
    {
        return view('admin.shu.create-realisasi-kegiatan-usaha');
    }

    public function storeRealisasiKegiatanUsaha(Request $request) 
    {
        $cleanJasaDariAnggota   = (int) str_replace(['Rp', '.', ','], '', $request->jasa_dari_anggota);
        $cleanUnitKonsumsi      = (int) str_replace(['Rp', '.', ','], '', $request->unit_konsumsi);
        $cleanJasaSkpb          = (int) str_replace(['Rp', '.', ','], '', $request->jasa_skpb);
        $cleanJasaAdministrasi  = (int) str_replace(['Rp', '.', ','], '', $request->jasa_administrasi);
        $cleanShuKpri           = (int) str_replace(['Rp', '.', ','], '', $request->shu_kpri);
        $cleanSewaRumah         = (int) str_replace(['Rp', '.', ','], '', $request->sewa_rumah);
        $cleanJasaTanahKopling  = (int) str_replace(['Rp', '.', ','], '', $request->jasa_tanah_kopling);
        $cleanJasaLainLain = (int) str_replace(['Rp', '.', ','], '', $request->jasa_lain_lain);
        $cleanJumlahPendapatan  = (int) str_replace(['Rp', '.', ','], '', $request->jumlah_pendapatan);

        $cleanBebanOrganisasi   = (int) str_replace(['Rp', '.', ','], '', $request->beban_organisasi);
        $cleanBebanOperasional  = (int) str_replace(['Rp', '.', ','], '', $request->beban_operasional);
        $cleanBebanUmum         = (int) str_replace(['Rp', '.', ','], '', $request->beban_umum);
        $cleanBebanLainLain     = (int) str_replace(['Rp', '.', ','], '', $request->beban_lain_lain);
        $cleanJumlahBeban       = (int) str_replace(['Rp', '.', ','], '', $request->jumlah_beban);

        $cleanShuSebelumPajak   = (int) str_replace(['Rp', '.', ','], '', $request->shu_sebelum_pajak);
        $cleanPajak             = (int) str_replace(['Rp', '.', ','], '', $request->pajak);
        $cleanShu               = (int) str_replace(['Rp', '.', ','], '', $request->shu);

        $request->merge([
            'jasa_dari_anggota'  => $cleanJasaDariAnggota,
            'unit_konsumsi'      => $cleanUnitKonsumsi,
            'jasa_skpb'          => $cleanJasaSkpb,
            'jasa_administrasi'  => $cleanJasaAdministrasi,
            'shu_kpri'           => $cleanShuKpri,
            'sewa_rumah'         => $cleanSewaRumah,
            'jasa_tanah_kopling' => $cleanJasaTanahKopling,
            'jasa_lain_lain' => $cleanJasaLainLain,
            'jumlah_pendapatan'  => $cleanJumlahPendapatan,

            'beban_organisasi'   => $cleanBebanOrganisasi,
            'beban_operasional'  => $cleanBebanOperasional,
            'beban_umum'         => $cleanBebanUmum,
            'beban_lain_lain'    => $cleanBebanLainLain,
            'jumlah_beban'       => $cleanJumlahBeban,

            'shu_sebelum_pajak'  => $cleanShuSebelumPajak,
            'pajak'              => $cleanPajak,
            'shu'                => $cleanShu,
        ]);

        $request->validate([
            'tahun'              => 'required|digits:4|integer|min:2020|max:' . date('Y'),
            'jasa_dari_anggota'  => 'required|integer|min:0',
            'unit_konsumsi'      => 'required|integer|min:0',
            'jasa_skpb'          => 'required|integer|min:0',
            'jasa_administrasi'  => 'required|integer|min:0',
            'shu_kpri'           => 'required|integer|min:0',
            'sewa_rumah'         => 'required|integer|min:0',
            'jasa_tanah_kopling' => 'required|integer|min:0',
            'jasa_lain_lain' => 'required|integer|min:0',
            'jumlah_pendapatan'  => 'required|integer|min:0',
            'beban_organisasi'   => 'required|integer|min:0',
            'beban_operasional'  => 'required|integer|min:0',
            'beban_umum'         => 'required|integer|min:0',
            'beban_lain_lain'    => 'required|integer|min:0',
            'jumlah_beban'       => 'required|integer|min:0',
            'shu_sebelum_pajak'  => 'required|integer|min:0',
            'pajak'              => 'required|integer|min:0',
            'shu'                => 'required|integer|min:0',
        ]);

        Shu::create([
            'tahun'              => $request->tahun,
            'jasa_dari_anggota'  => $request->jasa_dari_anggota,
            'unit_konsumsi'      => $request->unit_konsumsi,
            'jasa_skpb'          => $request->jasa_skpb,
            'jasa_administrasi'  => $request->jasa_administrasi,
            'shu_kpri'           => $request->shu_kpri,
            'sewa_rumah'         => $request->sewa_rumah,
            'jasa_tanah_kopling' => $request->jasa_tanah_kopling,
            'jasa_lain_lain' => $request->jasa_lain_lain,
            'jumlah_pendapatan'  => $request->jumlah_pendapatan,

            'beban_organisasi'   => $request->beban_organisasi,
            'beban_operasional'  => $request->beban_operasional,
            'beban_umum'         => $request->beban_umum,
            'beban_lain_lain'    => $request->beban_lain_lain,
            'jumlah_beban'       => $request->jumlah_beban,

            'shu_sebelum_pajak'  => $request->shu_sebelum_pajak,
            'pajak'              => $request->pajak,
            'jumlah_shu'         => $request->shu,
        ]);

        return redirect()->route('admin.shu.index-realisasi-kegiatan-usaha')->with('success', 'Berhasil Menambahkan SHU');
    } 

    public function destroyRealisasiKegiatanUsaha(string $id)
    {
        $shu = Shu::findOrFail($id);

        $shu->delete();

        return redirect()->route('admin.shu.index-realisasi-kegiatan-usaha')->with('success', 'Berhasil Menghapus SHU');
    }
}
