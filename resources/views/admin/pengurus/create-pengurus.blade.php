@extends('admin.layout.main')

@section('title', 'Tambah Pengurus')

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
            <a href="{{ route('admin.pengurus.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Pengurus</a>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{ route('admin.pengurus.create') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Tambah Pengurus</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>

  {{-- @if ($errors->any())
      <div class="w-full p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif --}}

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-bold">Tambah Pengurus</h1>
  </div>

  <!-- Form Tambah Anggota -->
  <form action="{{ route('admin.pengurus.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
      <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nama') }}" placeholder="Masukan Nama" required/>
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-900">Posisi</label>
      <select disabled  name="posisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
        <option selected value="pengurus">Pengurus</option>
      </select>
      <input type="hidden" name="posisi" value="pengurus">
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-900">Jabatan</label>
      <select name="jabatan" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
        <option value="" disabled {{ old('jabatan') ? '' : 'selected' }}>Pilih Jabatan</option>
        <option value="pengawas" {{ old('jabatan') == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
        <option value="bendahara" {{ old('jabatan') == 'bendahara' ? 'selected' : '' }} {{ $jumlahBendahara >= 2 ? 'disabled' : ''}}>
          Bendahara 
        </option>
      </select>
      @if ($jumlahBendahara >= 2)
        <p class="text-red-500 text-xs mt-1">* Jumlah bendahara sudah 2 orang</p>
      @endif
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-900">Nomor Telepon</label>
      <input type="text" id="telepon" name="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('telepon') }}" placeholder="Masukan No. Telepon" inputmode="numeric" pattern="[0-9]*" required/>
      @error('telepon')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
      <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('email') }}" placeholder="Masukan Email" required/>
      @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div class="mb-6">
      <label class="block mb-1 text-sm font-medium text-gray-900">Password</label>
      <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Password" required/>
      @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
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
    $(document).ready(function () {
      $('#telepon').on('input', function () {
        $(this).val($(this).val().replace(/\D/g, ''));
      });
    });
  </script>
@endpush
