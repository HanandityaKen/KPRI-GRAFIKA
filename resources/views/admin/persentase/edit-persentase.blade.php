@extends('admin.layout.main')

@section('title', 'Edit Persentase')

@section('content')
    <div>
      <hr class="my-8 border-t-[2px] border-green-800 opacity-20 mb-5" />

      {{-- Breadcrumb --}}
      <div class="mb-5">
        <nav class="flex" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
              <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
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
                <a href="{{ route('admin.persentase.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Persentase</a>
              </div>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="{{ route('admin.persentase.edit', $persentase->id) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Edit Persentase</a>
              </div>
            </li>
          </ol>
        </nav>
      </div>

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Edit Persentase</h1>
      </div>

      <form action="{{ route('admin.persentase.update', $persentase->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="block mb-1 text-sm font-medium text-gray-900">Nama Persentase</label>
          <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nama', $persentase->nama) }}" placeholder="Masukan Nama Persentase" required/>
        </div>
        <div class="mb-6">
          <label class="block mb-1 text-sm font-medium text-gray-900">Persentase</label>
          <input type="text" id="persentase" name="persentase" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('persentase', $persentase->persentase * 100) }}" inputmode="numeric" placeholder="Masukan Persentase" required/>
        </div>
        <div class="flex justify-start">
          <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
            Simpan
          </button>
        </div>
      </form>
    </div>
@endsection

@push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const persentase = document.getElementById('persentase');

        if (persentase.value !== '') {
            persentase.value += '%';
        }

        persentase.addEventListener('input', function() {
          let value = this.value.replace(/[^0-9.]/g, '');

          if ((value.match(/\./g) || []).length > 1) {
              value = value.replace(/\.+$/, ''); 
          }

          this.value = value !== '' ? value + '%' : '';
        });
      });
    </script>
@endpush