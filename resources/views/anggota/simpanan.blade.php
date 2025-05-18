@extends('anggota.layout.main')

@section('title', 'Simpanan')

@section('content')
    <!-- Header -->
    <header class="bg-green-100 text-green-700 w-full">
      <div class="max-w-none px-6 py-16 md:py-18 lg:py-18 text-center">
        <h1 class="text-xl lg:text-2xl font-semibold">Detail Simpanan</h1>
      </div>
    </header>

    <!-- Konten -->
    <div class="container mx-auto px-6 md:px-20 mt-10 mb-10">
      <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="border border-green-200 rounded-lg">
          <div class="p-6">
            <div class="divide-y divide-green-200">
              <div class="flex justify-between py-3">
                <span class="text-green-700 text-sm">Simpanan Pokok</span>
                <span class="text-green-700 text-sm">Rp {{ number_format($pokok, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-green-700 text-sm">Simpanan Wajib</span>
                <span class="text-green-700 text-sm">Rp {{ number_format($wajib, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-green-700 text-sm">Simpanan Manasuka</span>
                <span class="text-green-700 text-sm">Rp {{ number_format($manasuka, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-green-700 text-sm">Simpanan Wajib Pinjam</span>
                <span class="text-green-700 text-sm">Rp {{ number_format($wajib_pinjam, 0, ',', '.') }}</span>
              </div>
              <div class="flex justify-between py-3">
                <span class="text-green-700 text-sm">Simpanan Qurban</span>
                <span class="text-green-700 text-sm">Rp {{ number_format($qurban, 0, ',', '.') }}</span>
              </div>
            </div>
            <div class="mt-4 bg-green-100 p-4 font-semibold flex justify-between text-green-800 rounded text-sm">
              <span>Total</span>
              <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection