@extends('admin.layout.main')

@section('title', 'Dashboard')

@section('content')
<div>
  <hr class="my-5 border-t-[2px] border-green-800 opacity-20" />

  <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

  <!-- Dashboard Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-[#00B451] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="users" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">{{ $jumlahAnggota }}</p>
        <h3 class="text-white mb-2">Anggota Aktif</h3>
      </div>
    </div>
    <div class="bg-gradient-to-br from-[#00B451] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="wallet" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
        <h3 class="text-white mb-2">Total Simpanan</h3>
      </div>
    </div>
    <div class="bg-gradient-to-br from-[#00B451] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="credit-card" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($jumlahSaldo, 0, ',', '.') }}</p>
        <h3 class="text-white mb-2">Total Saldo Koperasi</h3>
      </div>
    </div>
  </div>

  @if (session('success'))
      <script>
          document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: '{{ session('success') }}',
                  confirmButtonColor: '#16a34a',
                  timer: 3000,
                  timerProgressBar: true,
                  showConfirmButton: false
              });
          });
      </script>
  @endif

  @if (session('error'))
      <div class="flex items-center p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
          <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Info</span>
          <div>
              <span class="font-medium">{{ session('error') }}</span>
          </div>
      </div>
  @endif

  <h1 class="text-lg font-bold mb-6">Tabel Pengajuan Pinjaman</h1>
  
  @livewire('pinjaman-dashboard-admin')
  
  <h1 class="text-lg font-bold mt-12 mb-6">Tabel Pengajuan Unit Konsumsi</h1>

  @livewire('unit-konsumsi-dashboard-admin')

  </div>
@endsection

@push('scripts')
<script>

</script>
@endpush