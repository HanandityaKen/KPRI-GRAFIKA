@extends('anggota.layout.main')

@section('title', 'Detail Riwayat')

@section('content')
    <!-- Header -->
    <header class="bg-green-100 text-green-700 w-full">
      <div class="max-w-none px-6 py-16 md:py-18 lg:py-18 text-center">
        <h1 class="text-xl lg:text-2xl font-semibold">Detail Riwayat</h1>
      </div>
    </header>

    <!-- Konten -->
    <div class="container mx-auto px-6 md:px-20 mt-10 mb-10">
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="border border-green-200 rounded-lg">
          <div class="p-6">
            <div class="mb-4">
              <label for="nama" class="block mb-1 text-sm font-medium text-gray-900">Nama Anggota</label>
              <input type="text" id="nama" value="{{ $riwayat->anggota->nama ?? $riwayat->nama_anggota }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
            </div>
            <div class="mb-4">
              <label for="tanggal" class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
              <input type="text" id="tanggal" value="{{ \Carbon\Carbon::parse($riwayat->tanggal)->translatedFormat('d-m-Y') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
            </div>
            @foreach ($fields as $key => $label)
              @if ($riwayat->$key > 0)
                <div class="mb-4">
                  <label for="{{ $key }}" class="block mb-1 text-sm font-medium text-gray-900">{{ $label }}</label>
                  <input 
                    type="text" 
                    id="{{ $key }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" 
                    value="Rp {{ number_format($riwayat->$key, 0, ',', '.') }}" 
                    readonly
                  />
                </div>
              @endif
            @endforeach

            @if ($riwayat->jenis_transaksi === 'kas keluar' && $riwayat->keterangan == 'Pinjaman')    
              <hr class="my-2 border-t-[1px] border-green-800 opacity-20 mb-3"/>

              <div class="grid grid-cols-2 gap-4">
                <div class="mb-3">
                  <label class="block mb-1 text-sm font-medium text-gray-900">Diajukan Oleh</label>
                  <input type="text" id="requested_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang mengajukan" value="{{ $riwayat->pinjaman->pengajuan_pinjaman->requested_by }}" readonly/>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Disetujui Oleh</label>
                    <input type="text" id="reviewed_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang menyesetujui" value="{{ $riwayat->pinjaman->pengajuan_pinjaman->reviewed_by }}" readonly/>
                </div>
              </div>
            @elseif ($riwayat->jenis_transaksi === 'kas keluar' && $riwayat->keterangan == 'Unit atau Barang Konsumsi')
              <hr class="my-2 border-t-[1px] border-green-800 opacity-20 mb-3"/>

              <div class="grid grid-cols-2 gap-4">
                <div class="mb-3">
                  <label class="block mb-1 text-sm font-medium text-gray-900">Diajukan Oleh</label>
                  <input type="text" id="requested_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang mengajukan" value="{{ $riwayat->unit_konsumsi->pengajuan_unit_konsumsi->requested_by }}" readonly/>
                </div>
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Disetujui Oleh</label>
                    <input type="text" id="reviewed_by" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Pengurus yang menyesetujui" value="{{ $riwayat->unit_konsumsi->pengajuan_unit_konsumsi->reviewed_by }}" readonly/>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    
@endsection