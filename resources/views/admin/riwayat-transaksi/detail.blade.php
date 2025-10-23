@extends('admin.layout.main')

@section('title', 'Detail Riwayat Transaksi')

@section('content')
    <div>
      <hr class="my-5 border-t-[2px] border-green-800 opacity-20 mb-5" />

      <div class="mb-5">
        <nav class="flex overflow-x-auto no-scrollbar" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse whitespace-nowrap">
            <li class="inline-flex items-center">
              <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
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
                <a href="{{ route('admin.riwayat-transaksi.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Riwayat Transaksi</a>
              </div>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="{{ route('admin.detail-riwayat-transaksi', $riwayatTransaksi->id) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Detail Riwayat Transaksi</a>
              </div>
            </li>
          </ol>
        </nav>
      </div>

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Detail Riwayat Transaksi</h1>
      </div>

      <div class="mb-4">
        <label for="nama" class="block mb-1 text-sm font-medium text-gray-900">Nama Anggota</label>
        <input type="text" id="nama" value="{{ $riwayatTransaksi->anggota->nama ?? $riwayatTransaksi->nama_anggota }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
      </div>

      <div class="mb-4">
        <label for="tanggal" class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
        <input type="text" id="tanggal" value="{{ \Carbon\Carbon::parse($riwayatTransaksi->tanggal)->translatedFormat('d-m-Y') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
      </div>

      <div class="mb-4">
        <label for="jenis_transaksi" class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
        <input type="text" id="jenis_transaksi" value="{{ ucwords($riwayatTransaksi->jenis_transaksi) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
      </div>

      @foreach ($fields as $key => $label)
        @if ($riwayatTransaksi->$key > 0)
          <div class="mb-4">
            <label for="{{ $key }}" class="block mb-1 text-sm font-medium text-gray-900">{{ $label }}</label>
            <input
              type="text"
              id="{{ $key }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2"
              value="Rp {{ number_format($riwayatTransaksi->$key, 0, ',', '.') }}"
              readonly
            />
          </div>
        @endif
      @endforeach

      @if ($riwayatTransaksi->jenis_transaksi === 'kas keluar' && $riwayatTransaksi->keterangan == 'Pinjaman')
        <hr class="my-2 border-t-[1px] border-green-800 opacity-20 mb-3"/>

        <div class="grid grid-cols-2 gap-4">
          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Diajukan Oleh</label>
            <input type="text" id="requested_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang mengajukan" value="{{ $riwayatTransaksi->created_by ?? $riwayatTransaksi->pinjaman->pengajuan_pinjaman->requested_by }}" readonly/>
          </div>
          <div class="mb-3">
              <label class="block mb-1 text-sm font-medium text-gray-900">Disetujui Oleh</label>
              <input type="text" id="reviewed_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang menyesetujui" value="{{ $riwayatTransaksi->approved_by ?? $riwayatTransaksi->pinjaman->pengajuan_pinjaman->reviewed_by }}" readonly/>
          </div>
        </div>
      @elseif ($riwayatTransaksi->jenis_transaksi === 'kas keluar' && $riwayatTransaksi->keterangan == 'Unit atau Barang Konsumsi')
        <hr class="my-2 border-t-[1px] border-green-800 opacity-20 mb-3"/>

        <div class="grid grid-cols-2 gap-4">
          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Diajukan Oleh</label>
            <input type="text" id="requested_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang mengajukan" value="{{ $riwayatTransaksi->created_by ?? $riwayatTransaksi->unit_konsumsi->pengajuan_unit_konsumsi->requested_by }}" readonly/>
          </div>
          <div class="mb-3">
              <label class="block mb-1 text-sm font-medium text-gray-900">Disetujui Oleh</label>
              <input type="text" id="reviewed_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang menyesetujui" value="{{ $riwayatTransaksi->approved_by ?? $riwayatTransaksi->unit_konsumsi->pengajuan_unit_konsumsi->reviewed_by }}" readonly/>
          </div>
        </div>
      @endif
    </div>
@endsection
