@extends('admin.layout.main')

@section('title', 'Edit Kas Harian')
    
@section('content')
<div>
  <hr class="my-8 border-t-[2px] border-green-800 opacity-20 mb-5" />

  {{-- Breadcrumb --}}
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
            <a href="{{ route('admin.kas-harian.edit', $kasHarian->id) }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Edit Kas Harian</a>
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
    @livewire('form-edit-kas-harian', ['id' => $kasHarian->id])
  @elseif ($kasHarian->jenis_transaksi == 'kas keluar')
      <form action="{{ route('admin.kas-harian.update', $kasHarian->id) }}" id="formCreateJkk" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
          <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" disabled>
            <option selected disabled>Pilih Jenis Transaksi</option>
            <option value="kas masuk" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
            <option value="kas keluar" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
            <input type="hidden" name="jenis_transaksi" value="{{ old('jenis_transaksi', $kasHarian->jenis_transaksi) }}">
          </select>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
          <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input id="datepicker-kas-keluar" name="tanggal" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::parse($kasHarian->tanggal)->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required >
          </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <select id="select_nama" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
              <option value="" disabled>Pilih Nama Anggota</option>
                @foreach($namaList as $id => $nama)
                    <option value="{{ $id }}" {{ old('nama', $kasHarian->anggota_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
          <input type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('pokok', $kasHarian->pokok) }}"/>
        </div> --}}
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
          <select name="wajib" id="wajib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
              <option value="">Pilih Nominal Wajib</option>
              <option value="250000" {{ old('wajib', $kasHarian->wajib) == '250000' ? 'selected' : '' }}>Rp 250.000</option>
              <option value="150000" {{ old('wajib', $kasHarian->wajib) == '150000' ? 'selected' : '' }}>Rp 150.000</option>
              <option value="100000" {{ old('wajib', $kasHarian->wajib) == '100000' ? 'selected' : '' }}>Rp 100.000</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
          <input type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka', $kasHarian->manasuka) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
          <select name="wajib_pinjam" id="wajib_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
              <option value="">Pilih Nominal Wajib Pinjam</option>
              <option value="15000" {{ old('wajib_pinjam', $kasHarian->wajib_pinjam) == '15000' ? 'selected' : '' }}>Rp 15.000</option>
              <option value="10000" {{ old('wajib_pinjam', $kasHarian->wajib_pinjam) == '10000' ? 'selected' : '' }}>Rp 10.000</option>
              <option value="5000" {{ old('wajib_pinjam', $kasHarian->wajib_pinjam) == '5000' ? 'selected' : '' }}>Rp 5.000</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
          <input type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban', $kasHarian->qurban) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
          <input type="text" id="lain_lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain_lain', $kasHarian->lain_lain) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Piutang</label>
          <input type="text" id="piutang" name="piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('piutang', $kasHarian->piutang) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Hutang</label>
          <input type="text" id="hutang" name="hutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Hutang" inputmode="numeric" value="{{ old('hutang', $kasHarian->hutang) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">B Umum</label>
          <input type="text" id="b_umum" name="b_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Umum" inputmode="numeric" value="{{ old('b_umum', $kasHarian->b_umum) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">B Orgns</label>
          <input type="text" id="b_orgns" name="b_orgns" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Orgns" inputmode="numeric" value="{{ old('b_orgns', $kasHarian->b_orgns) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">B Oprs</label>
          <input type="text" id="b_oprs" name="b_oprs" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Oprs" inputmode="numeric" value="{{ old('b_oprs', $kasHarian->b_oprs) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">B Lain</label>
          <input type="text" id="b_lain" name="b_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Lain" inputmode="numeric" value="{{ old('b_lain', $kasHarian->b_lain) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Tanah Kavling</label>
          <input type="text" id="tnh_kav" name="tnh_kav" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah Kavling" inputmode="numeric" value="{{ old('tnh_kav', $kasHarian->tnh_kav) }}" />
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
          <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan', $kasHarian->keterangan) }}"/>
        </div>
        <div class="flex justify-start">
          <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
            Simpan
          </button>
        </div>
      </form>
  @endif
</div>
@endsection

@push('scripts') 
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.format-rupiah').forEach(function (input) {
          
            let initialValue = input.value.replace(/\D/g, ""); // Hapus semua non-digit
            if (initialValue) {
                let formatted = new Intl.NumberFormat("id-ID").format(initialValue);
                input.value = `Rp ${formatted}`;
            }

            input.addEventListener("input", function (e) {
                let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
                let formatted = new Intl.NumberFormat("id-ID").format(value);
                e.target.value = value ? `Rp ${formatted}` : "";
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#select_nama", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            openOnFocus: true,
            maxOptions: 10,
        });
    });

    window.addEventListener('DOMContentLoaded', function () {
        let jumlahInput = document.getElementById('jumlah');
        let value = jumlahInput.value.replace(/\D/g, ''); // Ambil angka
        if (value) {
            jumlahInput.value = `Rp ${new Intl.NumberFormat('id-ID').format(value)}`;
        }
    });
  </script>
@endpush