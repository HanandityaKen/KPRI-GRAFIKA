@extends('pengurus.layout.main')

@section('title', 'Tambah Kas Harian')
    
@section('content')
<div>
  <hr class="my-2 border-t-[2px] border-green-800 opacity-20 mb-5" />

  {{-- Breadcrumb --}}
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
            <a href="{{ route('pengurus.kas-harian.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Kas Harian</a>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{ route('pengurus.kas-harian.create') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Tambah Kas Harian</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-bold">Tambah Kas Harian</h1>
  </div>

  @error('error')
    <div class="flex items-center p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">{{ $message }}</span>
        </div>
    </div>
  @enderror

  <div class="mb-3">
    <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
    <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
      <option selected disabled {{ old('jenis_transaksi') ? '' : 'selected' }}>Pilih Jenis Transaksi</option>
      <option value="kas masuk" {{ old('jenis_transaksi') == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
      <option value="kas keluar" {{ old('jenis_transaksi') == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
    </select>
  </div>
  <div id="kas_masuk" class="hidden">
      @livewire('pengurus.form-create-kas-harian')
  </div>
  <div id="kas_keluar" class="hidden">
      @livewire('pengurus.form-create-kas-harian-keluar')
  </div>
</div>
@endsection

@push('scripts') 
<script>
  document.addEventListener("DOMContentLoaded", function () {
      function initializeSelect2() {
          new TomSelect("#select_nama_kas_masuk", {
              create: false,
              sortField: {
                  field: "text",
                  direction: "asc"
              },
              openOnFocus: true,
              maxOptions: 10,
          });
          new TomSelect("#select_nama_kas_keluar", {
              create: false,
              sortField: {
                  field: "text",
                  direction: "asc"
              },
              openOnFocus: true,
              maxOptions: 10,
          });
      }

      initializeSelect2();

      Livewire.hook('message.processed', (message, component) => {
          initializeSelect2();
      });

      document.body.addEventListener("input", function (e) {
          if (e.target.classList.contains("format-rupiah")) {
              let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
              let formatted = new Intl.NumberFormat("id-ID").format(value);
              e.target.value = value ? `Rp ${formatted}` : "";
          }
      });

      const jenisTransaksi = document.querySelector("select[name='jenis_transaksi']");
      const kasMasuk = document.getElementById("kas_masuk");
      const kasKeluar = document.getElementById("kas_keluar");

      function toggleForms() {
          if (jenisTransaksi.value === "kas masuk") {
              kasMasuk.classList.remove("hidden");
              kasKeluar.classList.add("hidden");
          } else if (jenisTransaksi.value === "kas keluar") {
              kasKeluar.classList.remove("hidden");
              kasMasuk.classList.add("hidden");
          }
      }

      // Jalankan fungsi saat halaman dimuat (untuk menangani old() value)
      toggleForms();

      // Tambahkan event listener untuk menangani perubahan dropdown
      jenisTransaksi.addEventListener("change", toggleForms);
  });
</script>
@endpush