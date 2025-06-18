<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\Saldo;
use App\Models\KasHarian;
use App\Models\Jkk;
use App\Models\UnitKonsumsi;
use App\Models\AngsuranUnitKonsumsi;
use Carbon\Carbon;

class PengajuanUnitKonsumsiController extends Controller
{
    /**
     * Menampilkan halaman pengajuan unit konsumsi di pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pengurus.pengajuan-unit-konsumsi.index-pengajuan-unit-konsumsi');
    }

    /**
     * Menampilkan halaman detail pengajuan unit konsumsi di pengurus
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $namaList = Anggota::pluck('nama', 'id');

        return view('pengurus.pengajuan-unit-konsumsi.create-pengajuan-unit-konsumsi', compact('namaList'));
    }

    /**
     * Proses menyimpan data pengajuan unit konsumsi
     * 
     * Fungsi ini menangani proses membuat pengajuan unit konsumsi baru dengan:
     * - Validasi input
     * - Mengambil nama anggota berdasarkan ID
     * - Menghapus desimal dan menghapus format rupiah dari input jumlah nominal, nominal pokok, nominal bunga, angsuran, dan jumlah nominal
     * - Mengambil lama angsuran dari input dan menghapus karakter non-digit
     * - Membuat pengajuan unit konsumsi baru dengan data yang telah diproses
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'pengurus_id' => 'required',
            'nama_barang' => 'required',
            'nominal' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'jumlah_nominal' => 'required',
        ]);

        $nama = Anggota::findOrFail($request->anggota_id)->nama;

        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $jumlah_nominal = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_nominal));

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $request->lama_angsuran); 

        PengajuanUnitKonsumsi::create([
            'anggota_id' => $request->anggota_id,
            'nama_anggota' => $nama,
            'pengurus_id' => $request->pengurus_id,
            'nama_barang' => $request->nama_barang,
            'nominal' => $nominal,
            'lama_angsuran' => $lama_angsuran . ' bulan',
            'nominal_bunga' => $nominal_bunga,
            'nominal_pokok' => $nominal_pokok,
            'jumlah_nominal' => $jumlah_nominal,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengurus.pengajuan-unit-konsumsi.index')->with('success', 'Berhasil Menambahkan Data Pengajuan Unit Konsumsi');
    }

    /**
     * Menampilkan halaman edit pengajuan unit konsumsi di pengurus
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);

        if (!$pengajuanUnitKonsumsi){
            return back()->with(['error' => 'Pengajuan Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Pengajuan Unit Konsumsi sudah diproses']);
        }

        return view('pengurus.pengajuan-unit-konsumsi.edit-pengajuan-unit-konsumsi', compact('pengajuanUnitKonsumsi'));
    }

    /**
     * Proses mengupdate data pengajuan unit konsumsi
     * 
     * Fungsi ini menangani proses memperbarui pengajuan unit konsumsi dengan:
     * - Validasi input
     * - Mengambil nama anggota berdasarkan ID
     * - Menghapus desimal dan menghapus format rupiah dari input jumlah nominal, nominal pokok, nominal bunga, angsuran, dan jumlah nominal
     * - Mengambil lama angsuran dari input dan menghapus karakter non-digit
     * - Mengambil pengajuan unit konsumsi berdasarkan ID
     * - Memperbarui pengajuan unit konsumsi dengan data yang telah diproses
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pengurus_id' => 'required',
            'anggota_id' => 'required',
            'nama_barang' => 'required',
            'nominal' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'jumlah_nominal' => 'required',
        ]);

        $nama = Anggota::findOrFail($request->anggota_id)->nama;

        $nominal = intval(str_replace(['Rp', '.', ' '], '', $request->nominal));
        $nominal_pokok = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_pokok));
        $nominal_bunga = intval(str_replace(['Rp', '.', ' '], '', $request->nominal_bunga));
        $jumlah_nominal = intval(str_replace(['Rp', '.', ' '], '', $request->jumlah_nominal));

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $request->lama_angsuran);

        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);

        $pengajuanUnitKonsumsi->update([
            'anggota_id' => $request->anggota_id,
            'nama_anggota' => $nama,
            'pengurus_id' => $request->pengurus_id,
            'nama_barang' => $request->nama_barang,
            'nominal' => $nominal,
            'lama_angsuran' => $lama_angsuran . ' bulan',
            'nominal_bunga' => $nominal_bunga,
            'nominal_pokok' => $nominal_pokok,
            'jumlah_nominal' => $jumlah_nominal,
        ]);

        return redirect()->route('pengurus.pengajuan-unit-konsumsi.index')->with('success', 'Berhasil Mengubah Data Pengajuan Unit Konsumsi');
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
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::findOrFail($id);

        if (!$pengajuanUnitKonsumsi){
            return back()->with(['error' => 'Pengajuan Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Pengajuan Unit Konsumsi sudah diproses']);
        }

        $pengajuanUnitKonsumsi->delete();

        return redirect()->route('pengurus.pengajuan-unit-konsumsi.index')->with('success', 'Berhasil Menghapus Data Pengajuan Unit Konsumsi');
    }

    public function setujuiUnitKonsumsi($id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

        if (!$pengajuanUnitKonsumsi) {
            return back()->with(['error' => 'Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Unit Konsumsi sudah diproses']);
        }

        $unitKonsumsi = UnitKonsumsi::whereHas('pengajuan_unit_konsumsi', function ($query) use ($pengajuanUnitKonsumsi) {
            $query->where('anggota_id', $pengajuanUnitKonsumsi->anggota_id);
        })
        ->where('status', 'dalam pembayaran')
        ->exists();

        if ($unitKonsumsi) {
            return back()->with(['error' => 'Anggota ini masih memiliki angsuran yang belum lunas.']);
        }

        $nominalUnitKonsumsi = $pengajuanUnitKonsumsi->nominal;

        $saldoTerakhir = Saldo::first();

        if ($saldoTerakhir->saldo < $nominalUnitKonsumsi) {
            return back()->with(['error' => 'Saldo Koperasi tidak cukup']);
        }

        $kasHarian = KasHarian::create([
            'anggota_id' => $pengajuanUnitKonsumsi->anggota_id,
            'nama_anggota' => $pengajuanUnitKonsumsi->nama_anggota,
            'jenis_transaksi' => 'kas keluar',
            'tanggal' => $pengajuanUnitKonsumsi->created_at->format('Y-m-d'),
            'barang_kons' => $nominalUnitKonsumsi,

            'pokok'             => 0,
            'wajib'             => 0,
            'manasuka'          => 0,
            'wajib_pinjam'      => 0,
            'qurban'            => 0,
            'angsuran'          => 0,
            'jasa'              => 0,
            'js_admin'          => 0,
            'lain_lain'         => 0,
            'piutang'           => 0,
            'hutang'            => 0,
            'b_umum'            => 0,
            'b_orgns'           => 0,
            'b_oprs'            => 0,
            'b_lain'            => 0,
            'tnh_kav'           => 0,
            'keterangan'        => 'Unit atau Barang Konsumsi'
        ]);

        $saldoTerakhir->update([
            'saldo' => $saldoTerakhir->saldo - $nominalUnitKonsumsi
        ]);

        $bulan = strtolower($pengajuanUnitKonsumsi->created_at->translatedFormat('F'));
        $tahun = $pengajuanUnitKonsumsi->created_at->format('Y'); 

        Jkk::create([
            'kas_harian_id' => $kasHarian->id,
            'anggota_id' => $kasHarian->anggota_id,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        $unitKonsumsi = UnitKonsumsi::create([
            'pengajuan_unit_konsumsi_id' => $pengajuanUnitKonsumsi->id,
            'kas_harian_id' => $kasHarian->id,
            'status' => 'dalam pembayaran'
        ]);

        $lama_angsuran = (int) preg_replace('/[^0-9]/', '', $pengajuanUnitKonsumsi->lama_angsuran);

        AngsuranUnitKonsumsi::create([
            'unit_konsumsi_id' => $unitKonsumsi->id,
            'kurang_jasa' => intval($pengajuanUnitKonsumsi->nominal_bunga * $lama_angsuran),
            'kurang_angsuran' => intval($pengajuanUnitKonsumsi->nominal_pokok * $lama_angsuran),
            'sisa_angsuran' => $lama_angsuran
        ]);

        $pengajuanUnitKonsumsi->update([
            'status' => 'disetujui'
        ]);

        return back()->with('success', 'Pengajuan Unit Konsumsi berhasil disetujui');
    }

    /**
     * Proses tolak pengajuan unit konsumsi
     * 
     * Fungsi ini menangani proses penolakan pengajuan unit konsumsi anggota dengan:
     * - Mengambil pengajuan unit konsumsi berdasarkan ID
     * - Memeriksa apakah pengajuan unit konsumsi ditemukan
     * - Memeriksa status pengajuan unit konsumsi
     * - Memperbarui status pengajuan unit konsumsi menjadi ditolak
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tolakUnitKonsumsi($id)
    {
        $pengajuanUnitKonsumsi = PengajuanUnitKonsumsi::find($id);

        if (!$pengajuanUnitKonsumsi) {
            return back()->with(['error' => 'Unit Konsumsi tidak ditemukan']);
        }

        if ($pengajuanUnitKonsumsi->status !== 'menunggu') {
            return back()->with(['error' => 'Unit Konsumsi sudah diproses']);
        }

        $pengajuanUnitKonsumsi->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Pengajuan Unit Konsumsi berhasil ditolak');
    }
}
