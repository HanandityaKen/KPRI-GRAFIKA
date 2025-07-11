@extends('pengurus.layout.main')

@section('title', 'Anggota')
    
@section('content')
    
<div>
  <hr class="my-5 border-t-[2px] border-green-800 opacity-20 mb-5" />

  {{-- Breadcrumb --}}
  <div class="mb-5">
    <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
          <a href="{{ route('pengurus.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
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
            <a href="{{ route('pengurus.anggota.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Anggota</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>

  
  <div class="flex justify-between items-center mb-7">
    <h1 class="text-2xl font-bold">Anggota</h1>
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
      <script>
          document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: '{{ session('error') }}',
                  confirmButtonColor: '#16a34a',
                  timer: 3000,
                  timerProgressBar: true,
                  showConfirmButton: false
              });
          });
      </script>
  @endif

  {{-- <livewire:anggota-filter /> --}}
  @livewire('anggota-filter')

</div>
@endsection

@push('scripts')

  <script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data anggota akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#166534',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }
  </script>
@endpush