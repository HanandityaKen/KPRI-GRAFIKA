<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LimitPengajuanUnitKonsumsi;

class LimitPengajuanUnitKonsumsiController extends Controller
{
    public function index()
    {
        $limitPengajuanUnitKonsumsi = LimitPengajuanUnitKonsumsi::value('limit');

        return view('admin.limit-pengajuan-unit-konsumsi.index-limit-pengajuan-unit-konsumsi', compact('limitPengajuanUnitKonsumsi'));
    }

    public function update(Request $request)
    {
        $request->validate([
          'limit_pengajuan_unit_konsumsi' => 'required'
        ]);

        $limit = intval(str_replace(['Rp', '.', ' '], '', $request->limit_pengajuan_unit_konsumsi));

        $limitPengajuanUnitKonsumsi = LimitPengajuanUnitKonsumsi::first();

        $limitPengajuanUnitKonsumsi->update([
            'limit' => $limit
        ]);

        return redirect()->route('admin.limit-pengajuan-unit-konsumsi-index')->with('success', 'Berhasil Mengubah Limit Pengajuan Unit Konsumsi');
    }
}
