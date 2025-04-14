@extends('admin.layout.main')

@section('title', 'JKM')
    
@section('content')
<div>
  <hr class="my-5 border-t-[2px] border-green-800 opacity-20 mb-5" />

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
        <li>
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{ route('admin.jkm') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">JKM</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>
  
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-bold">Jurnal Kas Masuk</h1>
  </div>
  
  {{-- <div class="w-full flex justify-between items-center mb-4">
    <div class="flex items-center">
      <label for="yearFilter" class="mr-2">Tahun:</label>   
      <select id="yearFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
        <option value="2025">2025</option>
        <option value="2024">2024</option>
        <option value="2023">2023</option>
        <option value="2022">2022</option>
      </select>
    </div>
  </div> --}}
  
  {{-- <table class="w-full">
    <thead class="">
      <tr>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Uraian
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Tanggal
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Angsuran
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Pokok
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Wajib
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            M.Suka
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            SWP
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Qurban
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Jasa
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            J.Admin
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">
          <div class="flex items-center">
            Jumlah
            <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
          </div>
        </th>
        <th class="p-3 text-left">Action</th>
      </tr>
    </thead>
    <tbody id="anggotaTableBody">
      <!-- Data akan diisi oleh JavaScript -->
    </tbody>
  </table> --}}
  {{-- <div class="">
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
                      Uraian
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Tanggal
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Angsuran
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Pokok
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Wajib
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      M. Suka
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      SWP
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Qurban
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Jasa
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      J. Admin
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Lain-Lain
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Barang Konsumsi
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Total Jumlah
                  </span>
              </th>
          </tr>
      </thead>
      <tbody>
        @forelse ($jkms as $index => $jkm)
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap">{{$index + 1}}</td>
            <td>{{ $jkm->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($jkm->tanggal)->translatedFormat('j F Y') }}</td>
            <td>Rp {{ number_format($jkm->total_angsuran, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_pokok, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_wajib, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_m_suka, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_swp, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_qurban, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_jasa, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_j_admin, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_lain_lain, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_barang_kons, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($jkm->total_jumlah, 0, ',', '.') }}</td>
        </tr>
        @empty
            
        @endforelse
      </tbody>
    </table>
  </div> --}}

  @livewire('jkm-filter')

</div>

@endsection

@push('scripts')
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
              const dataTable = new simpleDatatables.DataTable("#default-table", {
                  searchable: true,
              });
          }
      });
    </script>
@endpush