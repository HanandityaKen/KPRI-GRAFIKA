<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;
use App\Models\Saldo;
use App\Models\KasHarian;
use App\Models\Jkm;
use App\Models\Jkk;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Carbon\Carbon;

class PengajuanPinjamanController extends Controller
{
    /**
     * Menampilkan halaman pengajuan pinjaman di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengurus.pengajuan-pinjaman.index-pengajuan-pinjaman');
    }

    /**
     * Menampilkan halaman create pengajuan pinjaman di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $namaList = Anggota::pluck('nama', 'id');

        return view('pengurus.pengajuan-pinjaman.create-pengajuan-pinjaman', compact('namaList'));
    }

    /**
     * Proses menyimpan data pengajuan pinjaman
     * 
     * Fungsi ini menangani proses membuat pengajuan pinjaman baru dengan:
     * - Validasi input
     * - Mengambil nama anggota berdasarkan ID
     * - Menghapus desimal dan menghapus format rupiah dari input jumlah pinjaman, nominal pokok, bunga, angsuran, biaya admin, dan total pinjaman
     * - Mengambil lama angsuran dari input dan menghapus karakter non-digit
     * - Membuat pengajuan pinjaman baru dengan data yang telah diproses
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {        
        $request->validate([
            'requested_by' => 'required',
            'tanggal' => 'required|date_format:d-m-Y',
            'anggota_id' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'nominal_angsuran' => 'required',
            'biaya_admin' => 'required',
            'total_pinjaman' => 'required',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

        $nama = Anggota::findOrFail($request->anggota_id)->nama;

        $jumlah_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_pinjaman));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $nominal_angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_angsuran));
        $biaya_admin = intval(str_replace(['Rp', '.', ' '], '', $request->biaya_admin));
        $total_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->total_pinjaman));

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $request->lama_angsuran); 

        PengajuanPinjaman::create([
            'anggota_id' => $request->anggota_id,
            'tanggal' => $tanggal,
            'nama_anggota' => $nama,
            'requested_by' => $request->requested_by,
            'jumlah_pinjaman' => $jumlah_pinjaman,
            'lama_angsuran' => $lama_angsuran . ' bulan',
            'nominal_pokok' => $nominal_pokok,
            'nominal_bunga' => $nominal_bunga,
            'nominal_angsuran' => $nominal_angsuran,
            'biaya_admin' => $biaya_admin,
            'total_pinjaman' => $total_pinjaman,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengurus.pengajuan-pinjaman.index')->with('success', 'Berhasil Menambahkan Data Pengajuan Pinjaman');
    }

    /**
     * Menampilkan halaman edit pengajuan pinjaman di pengurus
     * 
     * Jika pengajuan pinjaman sudah disetujui atau ditolak, tampilkan pesan error
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pengajuan Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pengajuan Pinjaman sudah diproses']);
        }

        return view('pengurus.pengajuan-pinjaman.edit-pengajuan-pinjaman', compact('pengajuanPinjaman'));
    }

    /**
     * Proses mengupdate data pengajuan pinjaman
     * 
     * Fungsi ini menangani proses memperbarui pengajuan pinjaman dengan:
     * - Validasi input
     * - Mengambil nama anggota berdasarkan ID
     * - Menghapus desimal dan menghapus format rupiah dari input jumlah pinjaman, nominal pokok, bunga, angsuran, biaya admin, dan total pinjaman
     * - Mengambil lama angsuran dari input dan menghapus karakter non-digit
     * - Mengambil pengajuan pinjaman berdasarkan ID
     * - Memperbarui pengajuan pinjaman dengan data yang telah diproses
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        $request->validate([
            'requested_by' => 'required',
            'anggota_id' => 'required',
            'tanggal' => 'required|date_format:d-m-Y',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'nominal_angsuran' => 'required',
            'biaya_admin' => 'required',
            'total_pinjaman' => 'required',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');

        $nama = Anggota::findOrFail($request->anggota_id)->nama;

        $jumlah_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_pinjaman));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $nominal_angsuran = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_angsuran));
        $biaya_admin = intval(str_replace(['Rp', '.', ' '], '', $request->biaya_admin));
        $total_pinjaman = intval(str_replace(['Rp', '.', ' '], '', $request->total_pinjaman));

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $request->lama_angsuran);

        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        $pengajuanPinjaman->update([
            'anggota_id' => $request->anggota_id,
            'tanggal' => $tanggal,
            'nama_anggota' => $nama,
            'requested_by' => $request->requested_by,
            'jumlah_pinjaman' => $jumlah_pinjaman,
            'lama_angsuran' => $lama_angsuran . ' bulan',
            'nominal_pokok' => $nominal_pokok,
            'nominal_bunga' => $nominal_bunga,
            'nominal_angsuran' => $nominal_angsuran,
            'biaya_admin' => $biaya_admin,
            'total_pinjaman' => $total_pinjaman,
        ]);

        return redirect()->route('pengurus.pengajuan-pinjaman.index')->with('success', 'Berhasil Mengubah Pengajuan Pinjaman');
    }

    /**
     * Proses menghapus pengajuan pinjaman
     * 
     * Jika pengajuan pinjaman sudah disetujui atau ditolak, tampilkan pesan error
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }
        
        $pengajuanPinjaman->delete();

        return redirect()->route('pengurus.pengajuan-pinjaman.index')->with('success', 'Berhasil Menghapus Pengajuan Pinjaman');
    }

    public function setujuiPinjaman($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::find($id);
        
        $reviewedBy = auth()->guard('pengurus')->user()->nama;

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $pinjaman = Pinjaman::whereHas('pengajuan_pinjaman', function ($query) use ($pengajuanPinjaman) {
            $query->where('anggota_id', $pengajuanPinjaman->anggota_id);
        })
        ->where('status', 'dalam pembayaran')
        ->orderBy('created_at', 'desc')
        ->first();

        $saldoTerakhir = Saldo::first();
        
        $jumlahPinjaman = $pengajuanPinjaman->jumlah_pinjaman;

        if ($saldoTerakhir->saldo < $jumlahPinjaman) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        // Cek angsuran lama
        $angsuranLama = Angsuran::whereHas('pinjaman.pengajuan_pinjaman', function ($query) use ($pengajuanPinjaman) {
            $query->where('anggota_id', $pengajuanPinjaman->anggota_id);
        })->orderBy('id', 'desc')->first();

        $jumlahPinjamanBaru = intval($pengajuanPinjaman->jumlah_pinjaman); 

        $kasHarianMasuk = KasHarian::create([
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'nama_anggota' => $pengajuanPinjaman->nama_anggota,
            'jenis_transaksi' => 'kas masuk',
            'tanggal' => $pengajuanPinjaman->tanggal,
            'angsuran' => 0,
            'js_admin' => $pengajuanPinjaman->biaya_admin,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'jasa'              => 0,
            'lain_lain'         => 0,
            'barang_kons'       => 0,
            'piutang'           => 0,
            'hutang'            => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Biaya Admin',
        ]);
        
        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo + $pengajuanPinjaman->biaya_admin
        ]);

        $bulan = strtolower(Carbon::parse($pengajuanPinjaman->tanggal)->translatedFormat('F'));
        $tahun = Carbon::parse($pengajuanPinjaman->tanggal)->format('Y');

        Jkm::create([
            'kas_harian_id' => $kasHarianMasuk->id,
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $kasHarianKeluar = KasHarian::create([
            'anggota_id' => $pengajuanPinjaman->anggota_id,
            'nama_anggota' => $pengajuanPinjaman->nama_anggota,
            'jenis_transaksi' => 'kas keluar',
            'tanggal' => $pengajuanPinjaman->tanggal,
            'hutang' => $jumlahPinjamanBaru,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'angsuran'          => 0,
            'jasa'              => 0,
            'js_admin'          => 0,
            'lain_lain'         => 0,
            'barang_kons'       => 0,
            'piutang'           => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Pinjaman'
        ]);

        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo - $jumlahPinjamanBaru
        ]);

        Jkk::create([
            'kas_harian_id' => $kasHarianKeluar->id,
            'anggota_id' => $kasHarianKeluar->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $pengajuanPinjaman->lama_angsuran);
        $kurangJasa = intval($pengajuanPinjaman->nominal_bunga * $lama_angsuran);

        $oldAngsuran = Angsuran::whereHas('pinjaman.pengajuan_pinjaman', function ($query) use ($pengajuanPinjaman) {
            $query->where('anggota_id', $pengajuanPinjaman->anggota_id);
        })
        ->orderBy('created_at', 'desc')
        ->value('kurang_angsuran');

        $oldAngsuran = $oldAngsuran ?? 0;
        $kurangAngsuran = intval($pengajuanPinjaman->jumlah_pinjaman + $oldAngsuran);

        if ($angsuranLama) {
            $angsuranLama->update([
                'kurang_jasa' => $kurangJasa,
                'kurang_angsuran' => $kurangAngsuran,
                'sisa_angsuran' => $lama_angsuran,
            ]);
        }

        if ($pinjaman) {
            $pinjaman->update([
                'jumlah_pinjaman' => $pengajuanPinjaman->jumlah_pinjaman + $pinjaman->jumlah_pinjaman,
            ]);     
        } else {
            $pinjaman = Pinjaman::create([
                'pengajuan_pinjaman_id' => $pengajuanPinjaman->id,
                'kas_harian_id' => $kasHarianKeluar->id,
                'jumlah_pinjaman' => $kurangAngsuran,
                'status' => 'dalam pembayaran'
            ]);

            
            Angsuran::create([
                'pinjaman_id' => $pinjaman->id,
                'kurang_jasa' => $kurangJasa,
                'kurang_angsuran' => $kurangAngsuran,
                'sisa_angsuran' => $lama_angsuran
            ]);
        }
        
        $kasHarianKeluar->update([
            'pinjaman_id' => $pinjaman->id
        ]);

        $pengajuanPinjaman->update([
            'reviewed_by' => $reviewedBy,
            'status' => 'disetujui',
        ]);

        return back()->with('success', 'Pengajuan Pinjaman berhasil disetujui');
    }

    /**
     * Proses tolak pengajuan pinjaman
     * 
     * Fungsi ini menangani proses penolakan pengajuan pinjaman anggota dengan:
     * - Mengambil pengajuan pinjaman berdasarkan ID
     * - Memeriksa apakah pengajuan pinjaman ditemukan
     * - Memeriksa status pengajuan pinjaman
     * - Memperbarui status pengajuan pinjaman menjadi ditolak
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolakPinjaman($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::find($id);

        $reviewedBy = auth()->guard('pengurus')->user()->nama;

        if (!$pengajuanPinjaman) {
            return back()->with(['error' => 'Pinjaman tidak ditemukan']);
        }

        if ($pengajuanPinjaman->status !== 'menunggu') {
            return back()->with(['error' => 'Pinjaman sudah diproses']);
        }

        $pengajuanPinjaman->update([
            'status' => 'ditolak',
            'reviewed_by' => $reviewedBy
        ]);

        return back()->with('success', 'Pengajuan Pinjaman berhasil ditolak');
    }

    public function detail($id)
    {
        $pengajuanPinjaman = PengajuanPinjaman::findOrFail($id);

        return view('pengurus.pengajuan-pinjaman.detail-pengajuan-pinjaman', compact('pengajuanPinjaman'));
    }
}
