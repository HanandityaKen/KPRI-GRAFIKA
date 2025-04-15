<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\PengajuanPinjaman;

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
            'pengurus_id' => 'required',
            'anggota_id' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'nominal_angsuran' => 'required',
            'biaya_admin' => 'required',
            'total_pinjaman' => 'required',
        ]);

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
            'nama_anggota' => $nama,
            'pengurus_id' => $request->pengurus_id,
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
            'pengurus_id' => 'required',
            'anggota_id' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required',
            'nominal_pokok' => 'required',
            'nominal_bunga' => 'required',
            'nominal_angsuran' => 'required',
            'biaya_admin' => 'required',
            'total_pinjaman' => 'required',
        ]);

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
            'nama_anggota' => $nama,
            'pengurus_id' => $request->pengurus_id,
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
}
