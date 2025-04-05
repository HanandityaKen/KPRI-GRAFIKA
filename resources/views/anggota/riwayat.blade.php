@extends('anggota.layout.main')

@section('title', 'Riwayat')

@section('content')
    <!-- Header -->
    <header class="bg-green-100 text-green-700 w-full">
      <div class="max-w-none px-6 py-16 md:py-20 lg:py-24 text-center">
        <h1 class="text-xl lg:text-2xl font-semibold">Riwayat</h1>
      </div>
    </header>

    <!-- Konten -->
    @livewire('anggota.riwayat-table')
    
@endsection