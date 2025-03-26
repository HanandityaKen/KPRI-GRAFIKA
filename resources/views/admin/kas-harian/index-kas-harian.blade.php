@extends('admin.layout.main')

@section('title', 'Kas Harian')
    
@section('content')
    <div>
      <hr class="my-2 border-t-[2px] border-green-800 opacity-20 mb-5" />

      <div class="mb-5">
        <nav class="flex" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
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
                <a href="{{ route('admin.kas-harian.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Kas Harian</a>
              </div>
            </li>
          </ol>
        </nav>
      </div>

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Kas Harian</h1>
      </div>

      @if (session('success'))
          <div class="flex items-center p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
              <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="sr-only">Info</span>
              <div>
                  <span class="font-medium">{{ session('success') }}</span>
              </div>
          </div>
      @endif

      @livewire('kas-harian-filter')

      {{-- <div class="w-full flex justify-between items-center mb-6">
        <div class="flex items-center">
          <label for="yearFilter" class="mr-2">Tahun:</label>
          <select id="yearFilter" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            <option selected disabled>-- Tahun --</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
          </select>
          <label for="monthFilter" class="mr-2">Bulan:</label>
          <select id="monthFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
            <option selected disabled>-- Bulan --</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
        <a href="{{ route('admin.kas-harian.create') }}">
          <button type="button" class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center">
            <i data-lucide="plus" class="mr-2"></i>
            Tambah Kas Harian
          </button>
        </a>
      </div> --}}

      {{-- <div class="mb-6 flex justify-end">
        <a
          href="{{ route('admin.kas-harian.create') }}"
          class="bg-green-800 text-white py-2 px-4 rounded-md flex items-center"
        >
          <i data-lucide="plus" class="mr-2"></i>
          Tambah Kas Harian
        </a>
      </div>
      
      <table id="default-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center text-[#6DA854]">
                        No
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Nama Anggota
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Jenis Transaksi
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Tanggal
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Keterangan
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Action
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
          @forelse ($kasHarian as $index => $dataKasHarian)
          <tr>
              <td class="font-medium text-gray-900 whitespace-nowrap">{{$index + 1}}</td>
              <td>{{$dataKasHarian->anggota->nama}}</td>
              <td>
                @if ($dataKasHarian->jenis_transaksi == 'kas masuk')
                    Kas Masuk
                @elseif ($dataKasHarian->jenis_transaksi == 'kas keluar')
                    Kas Keluar
                @endif
              </td>
              <td>{{ \Carbon\Carbon::parse($dataKasHarian->tanggal)->translatedFormat('j F Y') }}</td>
              <td>{{$dataKasHarian->keterangan}}</td>
              <td class="flex">
                <a href="{{ route('admin.kas-harian.edit', $dataKasHarian->id) }}">
                    <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                      Edit
                    </button>
                </a>
                <button 
                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                    onclick="confirmDelete({{ $dataKasHarian->id }})">
                      Hapus
                </button>
                <form id="delete-form-{{ $dataKasHarian->id }}" action="{{ route('admin.kas-harian.destroy', $dataKasHarian->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
              </td>
          </tr>
          @empty
              
          @endforelse
        </tbody>
      </table> --}}


    </div>
@endsection

@push('scripts')
    <script>  
      document.addEventListener("DOMContentLoaded", function () {
          if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
              const dataTable = new simpleDatatables.DataTable("#default-table", {
                  searchable: true,
                  // perPageSelect: true,
              });
          }
      });

      function confirmDelete(kasHarianId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kas harian akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#166534',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${kasHarianId}`).submit();
                }
            })
      }
    </script>
@endpush