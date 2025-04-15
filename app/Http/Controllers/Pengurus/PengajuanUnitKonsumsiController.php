<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\PengajuanUnitKonsumsi;

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
}
