@extends('admin.layout.main')

@section('title', 'Tambah Kas Harian')
    
@section('content')
<div>
  <hr class="my-2 border-t-[2px] border-green-800 opacity-20 mb-5" />

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
            <a href="{{ route('admin.kas-harian.create') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Tambah Kas Harian</a>
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
    <h1 class="text-xl font-bold">Tambah Kas Harian</h1>
  </div>

  <div class="mb-3">
    <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
    <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
      <option selected disabled {{ old('jenis_transaksi') ? '' : 'selected' }}>Pilih Jenis Transaksi</option>
      <option value="kas masuk" {{ old('jenis_transaksi') == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
      <option value="kas keluar" {{ old('jenis_transaksi') == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
    </select>
  </div>
  <div id="kas_masuk" class="hidden">
    <form action="{{ route('admin.kas-harian.store') }}" id="formCreateJkm" method="POST">
      @csrf
      <input type="text" name="jenis_transaksi" class="hidden"  value="kas masuk"/>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
        <div class="relative w-full">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </div>
          <input id="datepicker-kas-masuk" name="tanggal" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required >
        </div>
      </div>
      <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
          <select id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
            <option value="" disabled {{ old('nama') ? '' : 'selected' }}>Pilih Nama Anggota</option>
              @foreach($namaList as $id => $nama)
                  <option value="{{ $id }}" {{ old('nama') == $id ? 'selected' : '' }}>{{ $nama }}</option>
              @endforeach
          </select>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
        <input type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('pokok') }}"/>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
        <input type="text" id="wajib" name="wajib" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib" inputmode="numeric" value="{{ old('wajib') }}"/>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
        <input type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
        <input type="text" id="wajib pinjam" name="wajib_pinjam" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib Pinjam" inputmode="numeric" value="{{ old('wajib pinjam') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
        <input type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Angsuran</label>
        <input type="text" id="angsuran" name="angsuran" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Angsuran" inputmode="numeric" value="{{ old('angsuran') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
        <input type="text" id="jasa" name="jasa" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa" inputmode="numeric" value="{{ old('jasa') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa Admin</label>
        <input type="text" id="jasa admin" name="js_admin" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Admin" inputmode="numeric" value="{{ old('jasa admin') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
        <input type="text" id="lain-lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain-lain') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Barang Konsumsi</label>
        <input type="text" id="barang kons" name="barang_kons" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Barang Konsumsi" inputmode="numeric" value="{{ old('barang_kons') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
        <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan') }}"/>
      </div>
      <div class="flex justify-start">
        <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
          Simpan
        </button>
      </div>
    </form>
  </div>
  <div id="kas_keluar" class="hidden">
    <form action="{{ route('admin.kas-harian.store') }}" id="formCreateJkk" method="POST">
      @csrf
      <input type="text" name="jenis_transaksi" class="hidden"  value="kas keluar"/>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
        <div class="relative w-full">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </div>
          <input id="datepicker-kas-keluar" name="tanggal" datepicker datepicker-autohide datepicker-format="dd-mm-yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required >
        </div>
      </div>
      <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
          <select id="select_nama_kas_keluar" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
            <option value="" disabled {{ old('nama') ? '' : 'selected' }}>Pilih Nama Anggota</option>
              @foreach($namaList as $id => $nama)
                  <option value="{{ $id }}" {{ old('nama') == $id ? 'selected' : '' }}>{{ $nama }}</option>
              @endforeach
          </select>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
        <input type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('pokok') }}"/>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
        <input type="text" id="wajib" name="wajib" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib" inputmode="numeric" value="{{ old('wajib') }}"/>
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
        <input type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
        <input type="text" id="wajib pinjam" name="wajib_pinjam" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib Pinjam" inputmode="numeric" value="{{ old('wajib_pinjam') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
        <input type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Angsuran</label>
        <input type="text" id="angsuran" name="angsuran" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Angsuran" inputmode="numeric" value="{{ old('angsuran') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
        <input type="text" id="jasa" name="jasa" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa" inputmode="numeric" value="{{ old('jasa') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa Admin</label>
        <input type="text" id="jasa admin" name="js_admin" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Admin" inputmode="numeric" value="{{ old('jasa_admin') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
        <input type="text" id="lain-lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain_lain') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Piutang</label>
        <input type="text" id="piutang" name="piutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Piutang" inputmode="numeric" value="{{ old('piutang') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Hutang</label>
        <input type="text" id="hutang" name="hutang" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Hutang" inputmode="numeric" value="{{ old('hutang') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">B Umum</label>
        <input type="text" id="b_umum" name="b_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Umum" inputmode="numeric" value="{{ old('b_umum') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">B Orgns</label>
        <input type="text" id="b_orgns" name="b_orgns" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Orgns" inputmode="numeric" value="{{ old('b_orgns') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">B Oprs</label>
        <input type="text" id="b_oprs" name="b_oprs" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Oprs" inputmode="numeric" value="{{ old('b_oprs') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">B Lain</label>
        <input type="text" id="b_lain" name="b_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal B Lain" inputmode="numeric" value="{{ old('b_lain') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Tanah Kavling</label>
        <input type="text" id="tnh_kav" name="tnh_kav" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah Kavling" inputmode="numeric" value="{{ old('tnh_kav') }}" />
      </div>
      <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
        <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan') }}"/>
      </div>
      <div class="flex justify-start">
        <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts') 
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.format-rupiah').forEach(function (input) {
            input.addEventListener("input", function (e) {
                let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
                let formatted = new Intl.NumberFormat("id-ID").format(value);
                e.target.value = value ? `Rp ${formatted}` : "";
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#select_nama_kas_masuk", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            openOnFocus: true,
            maxOptions: 10,
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        new TomSelect("#select_nama_kas_keluar", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            openOnFocus: true,
            maxOptions: 10,
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
      const jenisTransaksi = document.querySelector("select[name='jenis_transaksi']");
      const kasMasuk = document.getElementById("kas_masuk");
      const kasKeluar = document.getElementById("kas_keluar");

      function toggleForms() {
        if (jenisTransaksi.value === "kas masuk") {
          kasMasuk.classList.remove("hidden");
          kasKeluar.classList.add("hidden");
        } else if (jenisTransaksi.value === "kas keluar") {
          kasKeluar.classList.remove("hidden");
          kasMasuk.classList.add("hidden");
        }
      }

      // Jalankan fungsi saat halaman dimuat (untuk menangani old() value)
      toggleForms();

      // Tambahkan event listener untuk menangani perubahan dropdown
      jenisTransaksi.addEventListener("change", toggleForms);
    });
  </script>
@endpush