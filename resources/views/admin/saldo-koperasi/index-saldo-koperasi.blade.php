@extends('admin.layout.main')

@section('title', 'Saldo Koperasi')
    
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
              <a href="{{ route('admin.saldo-koperasi-index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Saldo Koperasi</a>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-xl font-bold">Saldo Koperasi</h1>
    </div>

    <div class="flex items-center p-4 mb-5 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Perubahan saldo hanya dilakukan jika terdapat ketidaksesuaian data dengan pembukuan manual.</span>
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

    <div>
      <form action="{{ route('admin.saldo-koperasi-update') }}" id="form-saldo" method="POST">
        @csrf
        @method('PUT')
        <div>
          <div class="mb-6">
            <label class="block mb-1 text-sm font-medium text-gray-900">Saldo Koperasi</label>
            <input type="text" id="saldo" name="saldo" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('saldo', $saldos->saldo) }}" inputmode="numeric" placeholder="Masukan Nominal Saldo Koperasi" required/>
          </div>
          <div class="flex justify-start">
            <button type="button" id="btn-submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
                Simpan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
@push('scripts')
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          const form = document.getElementById('form-saldo');
          const submitButton = document.getElementById('btn-submit');

          document.querySelectorAll('.format-rupiah').forEach(function (input) {    
              let initialValue = input.value.replace(/\D/g, "");
              if (initialValue) {
                  let formatted = new Intl.NumberFormat("id-ID").format(initialValue);
                  input.value = `Rp ${formatted}`;
              }

              input.addEventListener("input", function (e) {
                  let value = e.target.value.replace(/\D/g, "");
                  let formatted = new Intl.NumberFormat("id-ID").format(value);
                  e.target.value = value ? `Rp ${formatted}` : "";
              });
          });

          form.addEventListener('submit', function (e) {
            e.preventDefault();
            
            Swal.fire({
              title: 'Apakah Anda yakin?',
              text: 'Data saldo koperasi akan diubah!',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#166534',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Simpan!',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit();
              }
            });
          });

          submitButton.addEventListener('click', function () {
            form.requestSubmit();
          });
        });
    </script>
@endpush