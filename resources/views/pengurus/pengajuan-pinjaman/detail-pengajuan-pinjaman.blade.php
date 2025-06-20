@extends('pengurus.layout.main')

@section('title', 'Detail Pengajuan Pinjaman')
    
@section('content')
    <div>
      <hr class="my-5 border-t-[2px] border-green-800 opacity-20 mb-5" />

      <div class="mb-5">
        <nav class="flex" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
              <a href="{{ route('pengurus.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Dashboard
              </a>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="{{ route('pengurus.pengajuan-pinjaman.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Pengajuan Pinjaman</a>
              </div>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="{{ route('pengurus.detail-pengajuan-pinjaman', $pengajuanPinjaman->id) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Detail Pengajuan Pinjaman</a>
              </div>
            </li>
          </ol>
        </nav>
      </div>

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Detail Pengajuan Pinjaman</h1>
      </div>

      <div>
        <div class="grid grid-cols-2 gap-4">
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" id="nama" name="nama" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nama" value="{{ $pengajuanPinjaman->nama_anggota }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah Pinjaman</label>
                <input type="text" id="jumlah_pinjaman" name="jumlah_pinjaman" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pinjaman" value="Rp {{ number_format($pengajuanPinjaman->jumlah_pinjaman, 0, ',', '.') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Lama Angsuran (Kali/Bulan)</label>
                <input type="text" id="lama_angsuran" name="lama_angsuran" class="format-bulan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Lama Angsuran" value="{{ preg_replace('/[^0-9]/', '', $pengajuanPinjaman->lama_angsuran) }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Pokok</label>
                <input type="text" id="nominal_pokok" name="nominal_pokok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Pokok" value="Rp {{ number_format($pengajuanPinjaman->nominal_pokok, 0, ',', '.') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Admin</label>
                <input type="text" id="biaya_admin" name="biaya_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Biaya Admin" value="Rp {{ number_format($pengajuanPinjaman->biaya_admin, 0, ',', '.') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Jasa</label>
                <input type="text" id="nominal_bunga" name="nominal_bunga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Jasa" value="Rp {{ number_format($pengajuanPinjaman->nominal_bunga, 0, ',', '.') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Uang Yang Diterima</label>
                <input type="text" id="total_pinjaman" name="total_pinjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Uang Yang Diterima" value="Rp {{ number_format($pengajuanPinjaman->total_pinjaman, 0, ',', '.') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Angsuran</label>
                <input type="text" id="nominal_angsuran" name="nominal_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Angsuran" value="Rp {{ number_format($pengajuanPinjaman->nominal_angsuran, 0, ',', '.') }}" readonly/>
            </div>
        </div>
        <hr class="my-2 border-t-[1px] border-green-800 opacity-20 mb-3"/>
        <div class="grid grid-cols-2 gap-4">
          <div class="mb-3">
              <label class="block mb-1 text-sm font-medium text-gray-900">Diajukan Oleh</label>
              <input type="text" id="requested_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang mengajukan" value="{{ $pengajuanPinjaman->requested_by }}" readonly/>
          </div>
          <div class="mb-3">
              <label class="block mb-1 text-sm font-medium text-gray-900">Disetujui/Ditolak Oleh</label>
              <input type="text" id="reviewed_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang menyesetujui/menolak" value="{{ $pengajuanPinjaman->reviewed_by }}" readonly/>
          </div>
        </div>
      </div>
    </div>
@endsection