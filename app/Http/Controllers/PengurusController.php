<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PengurusController extends Controller
{
    /**
     * Menampilkan halaman pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pengurus.index-pengurus');
    }

    /**
     * Menampilkan halaman tambah pengurus
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengambil semua anggota yang memiliki posisi 'anggota'
        $anggotaList = Anggota::where('posisi', 'anggota')->pluck('nama', 'id');
        
        // Menghitung jumlah anggota berdasarkan jabatan
        $jumlahKetua = Anggota::where('jabatan', 'ketua')->count();

        $jumlahSekretaris = Anggota::where('jabatan', 'sekretaris')->count();

        $jumlahBendahara = Anggota::where('jabatan', 'bendahara')->count();

        $jumlahPembantuUmum = Anggota::where('jabatan', 'pembantu umum')->count();
        
        $jumlahPengawas = Anggota::where('jabatan', 'pengawas')->count();

        return view('admin.pengurus.create-pengurus', compact('anggotaList', 'jumlahKetua', 'jumlahSekretaris', 'jumlahBendahara', 'jumlahPengawas', 'jumlahPembantuUmum'));
    }

    /**
     * Proses tambah pengurus
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'      => 'required|exists:anggota,id',
            'posisi'      => 'required|in:pengurus',
            'jabatan'      => 'required|in:pengawas,bendahara,sekretaris,pembantu umum,ketua',
        ]);

        $anggota = Anggota::find($request->anggota_id);

        $anggota->update([
            'posisi'  => $request->posisi,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Menambahkan Pengurus');
    }

    /**
     * Menampilkan halaman edit pengurus
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);

        $anggotaList = Anggota::where('posisi', 'anggota')
            ->orWhere('id', $id)
            ->pluck('nama', 'id');

        $jumlahKetua = Anggota::where('jabatan', 'ketua')->count();

        $jumlahSekretaris = Anggota::where('jabatan', 'sekretaris')->count();

        $jumlahBendahara = Anggota::where('jabatan', 'bendahara')->count();

        $jumlahPembantuUmum = Anggota::where('jabatan', 'pembantu umum')->count();
        
        $jumlahPengawas = Anggota::where('jabatan', 'pengawas')->count();

        return view('admin.pengurus.edit-pengurus', compact('user', 'anggotaList', 'jumlahKetua', 'jumlahBendahara', 'jumlahSekretaris', 'jumlahPengawas', 'jumlahPembantuUmum'));
    }

    /**
     * Proses edit pengurus
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {   
        $request->validate([
            'nama'      => 'required|string',
            'posisi'      => 'required|in:pengurus',
            'jabatan'      => 'required|in:pengawas,bendahara,sekretaris,pembantu umum,ketua',
        ]);

        $user = Anggota::findOrFail($id);

        $user->nama = $request->input('nama');
        $user->posisi = $request->input('posisi');
        $user->jabatan = $request->input('jabatan');

        $user->save();

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Mengubah Pengurus');
    }

    /**
     * Proses hapus pengurus
     * 
     * Fungsi ini menghapus pengurus dengan mengubah posisi dan jabatan anggota menjadi 'anggota' dan null.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $user = Anggota::findOrFail($id);

        $user->update([
            'posisi' => 'anggota',
            'jabatan' => null,
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Menghapus Pengurus');
    }
}
