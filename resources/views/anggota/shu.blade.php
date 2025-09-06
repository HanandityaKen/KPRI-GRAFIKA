@extends('anggota.layout.main')

@section('title', 'SHU')

@section('content')
    <header class="bg-green-100 text-green-700 w-full">
      <div class="max-w-none px-6 py-16 md:py-18 lg:py-18 text-center">
        <h1 class="text-xl lg:text-2xl font-semibold">SHU</h1>
      </div>
    </header>

    @livewire('anggota.shu')
@endsection