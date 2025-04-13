@extends('anggota.layout.main')

@section('title', 'Dashboard')

@section('content')
  <!-- Hero Section -->
  <section class="relative w-full h-screen">
    <img src="{{ asset('storage/assets/foto_smk_hd.webp') }}" alt="Background" class="w-full h-full object-cover relative" />
    <div class="absolute inset-0 flex flex-col justify-center items-start px-6 md:px-10">
      <h1 class="text-white text-3xl md:text-4xl font-bold">KPRI Grafika</h1>
      <p class="text-white mt-2 text-sm">Melayani</p>
      <div class="mt-4 space-x-2 md:space-x-4">
        <a href="{{ route('simpanan') }}" class="bg-green-600 text-white px-3 md:px-4 py-2 rounded-md text-sm">Simpanan</a>
        <a href="{{ route('pinjaman') }}" class="bg-green-600 text-white px-3 md:px-4 py-2 rounded-md text-sm">Pinjaman</a>
      </div>
    </div>
  </section>

  <!-- Tentang Kami Section -->
  <section class="py-16 px-6 md:px-20 bg-white flex flex-col md:flex-row items-center md:items-start">
    <div class="md:w-1/2 text-left">
      <h2 class="text-green-700 font-bold text-2xl mb-2 flex items-center">Tentang Kami</h2>
      <div class="flex items-center mb-4">
        <div class="w-36 h-1 bg-green-700 mr-0"></div>
        <span class="w-3 h-3 bg-green-700 inline-block"></span>
      </div>
      <p class="text-gray-600 text-sm leading-relaxed mb-6">
        KPRI Grafika merupakan koperasi simpan pinjam SMK Negeri 4 Malang, kini telah didigitalisasikan menjadi sebuah website yang memberikan akses cepat dan mudah, dapat diakses kapan saja dan di mana saja melalui perangkat digital.
        Dengan sistem keamanan canggih, setiap transaksi terlindungi untuk menjaga data anggota. Transparansi tinggi juga menjadi keunggulan, di mana informasi keuangan dan transaksi tersedia secara real-time bagi semua anggota. Selain
        itu, koperasi ini juga berperan dalam memberikan bantuan sosial kepada setiap anggotanya.
      </p>
    </div>

    <div class="md:w-1/2 relative flex justify-center md:justify-end mt-10 md:mt-0">
      <div class="relative w-96 h-96 flex justify-center items-center">
        <!-- Lingkaran hijau kiri atas -->
        <div class="absolute top-[-30px] left-[-30px] w-40 h-40 rounded-full border-[10px] border-green-400"></div>
        <!-- Gambar utama -->
        <img src="{{ asset('storage/assets/foto_smk.webp') }}" class="w-52 md:w-60 shadow-lg absolute top-0 left-8" />
        <img src="{{ asset('storage/assets/foto_smk.webp') }}" class="w-52 md:w-60 shadow-lg absolute top-50 right-8" />
        <img src="{{ asset('storage/assets/foto_smk.webp') }}" class="w-48 md:w-56 shadow-lg absolute bottom-0 left-10" />
        <!-- Lingkaran hijau kanan bawah -->
        <div class="absolute bottom-14 right-0 w-32 h-32 rounded-full border-[10px] border-green-300"></div>
      </div>
    </div>
  </section>

  <!-- Statistik Section -->
  <section class="py-16 px-6 md:px-20 bg-white">
    <h2 class="text-green-700 font-bold text-xl text-center mb-6">Data Koperasi</h2>
    <div class="bg-green-100 p-14 rounded-lg shadow-md flex flex-col md:flex-row justify-between items-center text-center space-y-6 md:space-y-0 md:space-x-8">
      <div class="flex flex-col items-center">
        <i data-lucide="users" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">{{ $jumlahAnggota }}</h3>
        <p class="text-sm text-gray-600">Anggota</p>
      </div>
      <div class="flex flex-col items-center">
        <i data-lucide="circle-dollar-sign" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</h3>
        <p class="text-sm text-gray-600">Total Simpanan</p>
      </div>
      <div class="flex flex-col items-center">
        <i data-lucide="calendar" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</h3>
        <p class="text-sm text-gray-600">Total Pinjaman</p>
      </div>
      <div class="flex flex-col items-center">
        <i data-lucide="utensils" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">Rp {{ number_format($totalUnitKonsumsi, 0, ',', '.') }}</h3>
        <p class="text-sm text-gray-600">Total Unit Konsumsi</p>
      </div>
    </div>
  </section>

  <!-- Total Akumulasi Uang Section -->
  <section class="py-16 px-6 md:px-20 bg-white">
    <h2 class="text-green-700 font-bold text-xl text-center mb-6">Total Akumulasi Uang, {{ Auth::guard('anggota')->user()->nama }}</h2>
    <div class="bg-green-100 p-14 rounded-lg shadow-md flex flex-col md:flex-row justify-between items-center text-center space-y-6 md:space-y-0 md:space-x-8">
      <div class="flex flex-col items-center">
        <i data-lucide="banknote" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">Rp {{ number_format($simpananAnggota, 0, ',', '.') }}</h3>
        <p class="text-sm text-gray-600">Total Simpanan</p>
      </div>
      <div class="flex flex-col items-center">
        <i data-lucide="handshake" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">Rp {{ number_format($sisaPinjaman, 0, ',', '.') }}</h3>
        <p class="text-sm text-gray-600">Sisa Pinjaman</p>
      </div>
      <div class="flex flex-col items-center">
        <i data-lucide="utensils" class="text-green-700 w-6 h-6"></i>
        <h3 class="text-lg font-bold text-green-800">Rp {{ number_format($sisaUnitKonsumsi, 0, ',', '.') }}</h3>
        <p class="text-sm text-gray-600">Sisa Unit Konsumsi</p>
      </div>
    </div>
  </section>
@endsection