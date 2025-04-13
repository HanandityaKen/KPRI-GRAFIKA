<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use App\Models\Simpanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('admin.anggota.index-anggota');
    }

    public function create()
    {
        return view('admin.anggota.create-anggota');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_anggota'    => 'required|numeric|unique:anggota',
            'nama'      => 'required|string',
            'jenis_pegawai' => 'required|in:PNS,P3K,GTT',
            'posisi'      => 'required|in:anggota',
            'telepon'   => 'nullable|numeric|regex:/^08[0-9]{8,11}$/',
            'email'   => 'nullable|email',
            'password'   => 'required|string|min:8',
        ], [
            'no_anggota.unique' => '* No Anggota sudah terdaftar.',
            'telepon.regex' => '* Nomor telepon harus dimulai dengan 08 dan berisi 10-13 digit.',
            'telepon.numeric' => '* Nomor telepon hanya boleh berisi angka. ',
            'password.min' => '* Password harus berisi minimal 8 karakter. ',
        ]);

        Anggota::create([
            'no_anggota' => $request->no_anggota,
            'nama' => $request->nama,
            'jenis_pegawai' => $request->jenis_pegawai,
            'posisi' => $request->posisi,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Menambahkan Anggota');
    }

    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);
        return view('admin.anggota.edit-anggota', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_anggota' => 'required|numeric|unique:anggota,no_anggota,' . $id . ',id',
            'nama'      => 'required|string',
            'jenis_pegawai' => 'required|in:PNS,P3K,GTT',
            'telepon'   => 'nullable|numeric|regex:/^08[0-9]{8,11}$/',
            'email'   => 'nullable|email',
            'password'   => 'nullable|string|min:8',
        ], [
            'no_anggota.unique' => '* No Anggota sudah terdaftar.',
            'telepon.regex' => '* Nomor telepon harus dimulai dengan 08 dan berisi 10-13 digit.',
            'telepon.numeric' => '* Nomor telepon hanya boleh berisi angka. ',
            'password.min' => '* Password harus berisi minimal 8 karakter. ',
        ]);

        $user = Anggota::findOrFail($id);

        $user->no_anggota = $request->input('no_anggota');
        $user->nama = $request->input('nama');
        $user->jenis_pegawai = $request->input('jenis_pegawai');
        $user->telepon = $request->input('telepon');
        $user->email = $request->input('email');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update the kas_harian table with the new name
        KasHarian::where('anggota_id', $user->id)->update([
            'nama_anggota' => $user->nama
        ]);

        // Update the pengajuan_pinjaman table with the new name
        PengajuanPinjaman::where('anggota_id', $user->id)->update([
            'nama_anggota' => $user->nama
        ]);

        // Update the pengajuan_unit_konsumsi table with the new name
        PengajuanUnitKonsumsi::where('anggota_id', $user->id)->update([
            'nama_anggota' => $user->nama
        ]);

        // Update the simpanan table with the new name
        Simpanan::where('anggota_id', $user->id)->update([
            'no_anggota' => $user->no_anggota,
            'nama_anggota' => $user->nama
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Mengubah Anggota');
    }

    public function destroy(string $id)
    {
        $user = Anggota::findOrFail($id);

        $pinjaman = Pinjaman::whereHas('pengajuan_pinjaman', function ($query) use ($user) {
            $query->where('anggota_id', $user->id);
        })
        ->where('status', 'dalam pembayaran')
        ->orderBy('created_at', 'desc')
        ->first();

        if ($pinjaman) {
            return redirect()->route('admin.anggota.index')->with('error', $user->nama . ' masih memiliki angsuran pinjaman yang belum lunas.');
        }

        $unitKonsumsi = UnitKonsumsi::whereHas('pengajuan_unit_konsumsi', function ($query) use ($user) {
            $query->where('anggota_id', $user->id);
        })
        ->where('status', 'dalam pembayaran')
        ->orderBy('created_at', 'desc')
        ->first();

        if ($unitKonsumsi) {
            return redirect()->route('admin.anggota.index')->with('error', $user->nama . ' masih memiliki angsuran unit konsumsi yang belum lunas.');
        }

        $totalManasuka = Simpanan::where('anggota_id', $user->id)->value('manasuka');
        $totalWajib    = Simpanan::where('anggota_id', $user->id)->value('wajib');
        $totalQurban   = Simpanan::where('anggota_id', $user->id)->value('qurban');

        if ($totalManasuka > 0 || $totalWajib > 0 || $totalQurban > 0) {
            KasHarian::create([
                'anggota_id'      => $user->id,
                'nama_anggota'    => $user->nama,
                'jenis_transaksi' => 'kas keluar',
                'tanggal'         => now()->format('Y-m-d'),
                'manasuka'        => $totalManasuka,
                'wajib'           => $totalWajib,
                'qurban'          => $totalQurban,
                'keterangan'      => 'Pengembalian dana simpanan anggota yang dihapus',
            ]);
        }

        Simpanan::where('anggota_id', $user->id)->delete();

        $user->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Menghapus Anggota');
    }
}
