<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\KasHarian;
use App\Models\PengajuanPinjaman;
use App\Models\Pinjaman;
use App\Models\PengajuanUnitKonsumsi;
use App\Models\UnitKonsumsi;
use App\Models\Simpanan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    public function index()
    {
        return view('pengurus.anggota.index-anggota');
    }

    public function create()
    {
        return view('pengurus.anggota.create-anggota');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_anggota'    => 'required|numeric|unique:anggota',
            'nama'      => 'required|string',
            'jenis_pegawai' => 'required|string',
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

        return redirect()->route('pengurus.anggota.index')->with('success', 'Berhasil Menambahkan Anggota');
    }

    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);
        return view('pengurus.anggota.edit-anggota', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_anggota' => 'required|numeric|unique:anggota,no_anggota,' . $id . ',id',
            'nama'      => 'required|string',
            'jenis_pegawai' => 'required|string',
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

        $oldName = $user->nama;

        $user->no_anggota = $request->input('no_anggota');
        $user->nama = $request->input('nama');
        $user->jenis_pegawai = $request->input('jenis_pegawai');
        $user->telepon = $request->input('telepon');
        $user->email = $request->input('email');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Perbarui tabel kas_harian dengan nama anggota yang baru
        KasHarian::where('anggota_id', $user->id)->update([
            'nama_anggota' => $user->nama
        ]);

        // Perbarui tabel pengajuan_pinjaman dengan nama anggota yang baru
        PengajuanPinjaman::where('anggota_id', $user->id)->update([
            'nama_anggota' => $user->nama
        ]);

        // Perbarui tabel pengajuan_unit_konsumsi dengan nama anggota yang baru
        PengajuanUnitKonsumsi::where('anggota_id', $user->id)->update([
            'nama_anggota' => $user->nama
        ]);

        if ($oldName !== $user->nama) {
            PengajuanPinjaman::where('reviewed_by', $oldName)->update(['reviewed_by' => $user->nama]);
            PengajuanPinjaman::where('requested_by', $oldName)->update(['requested_by' => $user->nama]);
        
            PengajuanUnitKonsumsi::where('reviewed_by', $oldName)->update(['reviewed_by' => $user->nama]);
            PengajuanUnitKonsumsi::where('requested_by', $oldName)->update(['requested_by' => $user->nama]);
        }

        // Perbarui tabel simpanan dengan nama anggota yang baru
        Simpanan::where('anggota_id', $user->id)->update([
            'no_anggota' => $user->no_anggota,
            'nama_anggota' => $user->nama
        ]);

        return redirect()->route('pengurus.anggota.index')->with('success', 'Berhasil Mengubah Anggota');
    }

    public function destroy(string $id)
    {
        $user = Anggota::findOrFail($id);

        // Periksa apakah pinjaman terakhir anggota masih dalam pembayaran
        $pinjaman = Pinjaman::whereHas('pengajuan_pinjaman', function ($query) use ($user) {
            $query->where('anggota_id', $user->id);
        })
        ->where('status', 'dalam pembayaran')
        ->orderBy('created_at', 'desc')
        ->first();

        // Tampilkan pesan error jika pinjaman masih dalam pembayaran
        if ($pinjaman) {
            return redirect()->route('pengurus.anggota.index')->with('error', $user->nama . ' masih memiliki angsuran pinjaman yang belum lunas.');
        }

        // Periksa apakah unit konsumsi terakhir anggota masih dalam pembayaran
        $unitKonsumsi = UnitKonsumsi::whereHas('pengajuan_unit_konsumsi', function ($query) use ($user) {
            $query->where('anggota_id', $user->id);
        })
        ->where('status', 'dalam pembayaran')
        ->orderBy('created_at', 'desc')
        ->first();

        // Tampilkan pesan error jika unit konsumsi masih dalam pembayaran
        if ($unitKonsumsi) {
            return redirect()->route('pengurus.anggota.index')->with('error', $user->nama . ' masih memiliki angsuran unit konsumsi yang belum lunas.');
        }

        // Mengambil manasuka, wajib, dan qurban dari simpanan anggota
        $totalManasuka = Simpanan::where('anggota_id', $user->id)->value('manasuka');
        $totalWajib    = Simpanan::where('anggota_id', $user->id)->value('wajib');
        $totalQurban   = Simpanan::where('anggota_id', $user->id)->value('qurban');

        // Proses pengembalian dana simpanan anggota yang dihapus
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

        // Hapus simpanan anggota dari tabel simpanan
        Simpanan::where('anggota_id', $user->id)->delete();

        //Hapus anggota dari tabel anggota
        $user->delete();

        return redirect()->route('pengurus.anggota.index')->with('success', 'Berhasil Menghapus Anggota');
    }
}
