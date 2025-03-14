@extends('pengurus.layout.main')

@section('title', 'Dashboard')

@section('content')
<div>
  <hr class="my-2 border-t-[2px] border-green-800 opacity-20" />

  <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

  <!-- Dashboard Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-[#003705] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="users" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">{{ $jumlahAnggota }}</p>
        <h3 class="text-white mb-2">Anggota Aktif</h3>
      </div>
    </div>
    <div class="bg-gradient-to-br from-[#2E6A27] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="wallet" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($jumlahSaldo, 0, ',', '.') }}</p>
        <h3 class="text-white mb-2">Total Simpanan</h3>
      </div>
    </div>
    <div class="bg-gradient-to-br from-[#6DA854] to-green-700 shadow rounded-lg p-6 flex items-center">
      <i data-lucide="credit-card" class="text-white mr-3"></i>
      <div>
        <p class="text-2xl font-bold text-white">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
        <h3 class="text-white mb-2">Total Saldo Koperasi</h3>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>

</script>
@endpush