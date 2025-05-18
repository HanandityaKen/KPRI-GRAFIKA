@extends('anggota.layout.main')

@section('title', 'Unit Konsumsi')

@section('content')
    <!-- Header -->
    <header class="bg-green-100 text-green-700 w-full">
      <div class="max-w-none px-6 py-16 md:py-18 lg:py-18 text-center">
        <h1 class="text-xl lg:text-2xl font-semibold">Detail Unit Konsumsi</h1>
      </div>
    </header>

    <!-- Konten -->
    <div class="container mx-auto px-6 md:px-20 mt-10 mb-10">
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="border border-green-200 rounded-lg">
          <div class="p-6">
            <div class="divide-y divide-green-200">
              @if ($angsuranUnitKonsumsi)
                <div class="flex justify-between py-3">
                  <span class="text-green-700 text-sm">Nama Barang</span>
                  <span class="text-green-700 text-sm">{{ ucwords($angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->nama_barang) }}</span>
                </div>
                <div class="flex justify-between py-3">
                  <span class="text-green-700 text-sm">Nominal</span>
                  <span class="text-green-700 text-sm">Rp {{ number_format($angsuranUnitKonsumsi->unit_konsumsi->pengajuan_unit_konsumsi->nominal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-3">
                  <span class="text-green-700 text-sm">Sisa Angsuran</span>
                  <span class="text-green-700 text-sm">{{ $angsuranUnitKonsumsi->sisa_angsuran }} Kali</span>
                </div>
                <div class="flex justify-between py-3">
                  <span class="text-green-700 text-sm">Kurang Angsuran</span>
                  <span class="text-green-700 text-sm">Rp {{ number_format($angsuranUnitKonsumsi->kurang_angsuran, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-3">
                  <span class="text-green-700 text-sm">Kurang Jasa</span>
                  <span class="text-green-700 text-sm">Rp {{ number_format($angsuranUnitKonsumsi->kurang_jasa, 0, ',', '.') }}</span>
                </div>
              @else
                <div class="flex justify-center items-center py-10">
                  <span class="text-gray-500 text-sm md:text-lg">Anda tidak memiliki angsuran unit konsumsi</span>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection