@extends('pengurus.layout.main')

@section('title', 'Edit Kas Harian')
    
@section('content')
<div>
  <hr class="my-5 border-t-[2px] border-green-800 opacity-20 mb-5" />

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
            <a href="{{ route('pengurus.kas-harian.edit', $kasHarian->id) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Edit Kas Harian</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>

  @if ($errors->any())
      <div class="w-full p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-bold">Edit Kas Harian</h1>
  </div>

  <!-- Form Tambah Anggota -->
  @if ($kasHarian->jenis_transaksi == 'kas masuk')    
      @livewire('pengurus.form-edit-kas-harian', ['id' => $kasHarian->id])  
  @elseif ($kasHarian->jenis_transaksi == 'kas keluar')
      @livewire('pengurus.form-edit-kas-harian-keluar', ['id' => $kasHarian->id])  
  @endif
</div>
@endsection

@push('scripts') 
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.body.addEventListener("input", function (e) {
            if (e.target.classList.contains("format-rupiah")) {
                let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
                e.target.value = value ? `Rp ${new Intl.NumberFormat("id-ID").format(value)}` : "";
            }
        });

        document.querySelectorAll(".format-rupiah").forEach(function (input) {
            let value = input.value.replace(/\D/g, ""); // Hapus semua non-digit saat halaman dimuat
            if (value) {
                input.value = `Rp ${new Intl.NumberFormat("id-ID").format(value)}`;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
      flatpickr("#datepicker-kas-masuk", {
        dateFormat: "d-m-Y",
        allowInput: true,
        position: "below",
        locale: "id"
      });
    });

    document.addEventListener('DOMContentLoaded', function () {
      flatpickr("#datepicker-kas-keluar", {
        dateFormat: "d-m-Y",
        allowInput: true,
        position: "below",
        locale: "id"
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
      let selectKasMasuk = document.querySelector("#select_nama_kas_masuk");
      let selectKasKeluar = document.querySelector("#select_nama_kas_keluar");

      if (selectKasMasuk) {
          new TomSelect(selectKasMasuk, {
              create: false,
              sortField: {
                  field: "text",
                  direction: "asc"
              },
              openOnFocus: true,
              maxOptions: 10,
          });
      }

      if (selectKasKeluar) {
          new TomSelect(selectKasKeluar, {
              create: false,
              sortField: {
                  field: "text",
                  direction: "asc"
              },
              openOnFocus: true,
              maxOptions: 10,
          });
      }
    });
  </script>
@endpush