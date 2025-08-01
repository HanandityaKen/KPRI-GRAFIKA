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
use App\Models\Saldo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    /**
     * Menampilkan halaman daftar anggota.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.anggota.index-anggota');
    }

    /** 
     * Menampilkan halaman untuk membuat atau menambahkan anggota baru.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.anggota.create-anggota');
    }

    /**
     * Proses menyimpan anggota baru ke dalam tabel anggota.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
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

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Menambahkan Anggota');
    }

    /**
     * Menampilkan halaman edit anggota berdasarkan ID.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $user = Anggota::findOrFail($id);
        return view('admin.anggota.edit-anggota', compact('user'));
    }

    /**
     * Proses memperbarui data anggota berdasarkan ID dan mengubah field nama_anggota di tabel kas_harian, simpanan, pengajuan_pinjaman dan pengajuan_unit_konsumsi.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Mengubah Anggota');
    }

    /**
     * Menghapus anggota berdasarkan ID jika tidak memiliki pinjaman atau unit konsumsi yang belum lunas
     * 
     * Hapus simpanan anggota dan catat pengembalian dana simpanan ke dalam kas_harian.
     * 
     * @param string $id 
     * @return \Illuminate\Http\RedirectResponse
     */
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
            return redirect()->route('admin.anggota.index')->with('error', $user->nama . ' masih memiliki angsuran pinjaman yang belum lunas.');
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
            return redirect()->route('admin.anggota.index')->with('error', $user->nama . ' masih memiliki angsuran unit konsumsi yang belum lunas.');
        }

        // Mengambil manasuka, wajib, dan qurban dari simpanan anggota
        $totalPokok   = Simpanan::where('anggota_id', $user->id)->value('pokok');
        $totalWajib    = Simpanan::where('anggota_id', $user->id)->value('wajib');
        $totalManasuka = Simpanan::where('anggota_id', $user->id)->value('manasuka');
        $totalWajibPinjam = Simpanan::where('anggota_id', $user->id)->value('wajib_pinjam');
        $totalQurban   = Simpanan::where('anggota_id', $user->id)->value('qurban');

        $saldo = Saldo::first();

        if ($saldo->saldo < ($totalPokok + $totalWajib + $totalManasuka + $totalWajibPinjam + $totalQurban)) {
            return back()->with('error', 'Saldo tidak mencukupi untuk mengembalikan dana simpanan anggota yang dihapus.');
        }

        // Proses pengembalian dana simpanan anggota yang dihapus
        if ($totalPokok > 0 || $totalWajib > 0 || $totalManasuka > 0 || $totalWajibPinjam > 0 || $totalQurban > 0) {
            KasHarian::create([
                'anggota_id'      => $user->id,
                'nama_anggota'    => $user->nama,
                'jenis_transaksi' => 'kas keluar',
                'tanggal'         => now()->format('Y-m-d'),
                'pokok'           => $totalPokok,
                'wajib'           => $totalWajib,
                'manasuka'        => $totalManasuka,
                'wajib_pinjam'    => $totalWajibPinjam,
                'qurban'          => $totalQurban,
                'keterangan'      => 'Pengembalian dana simpanan anggota yang dihapus',
            ]);
        }

        // Hapus simpanan anggota dari tabel simpanan
        Simpanan::where('anggota_id', $user->id)->delete();

        $saldo->update([
            'saldo' => $saldo->saldo - ($totalPokok + $totalWajib + $totalManasuka + $totalWajibPinjam + $totalQurban)
        ]);

        //Hapus anggota dari tabel anggota
        $user->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Menghapus Anggota');
    }
}
