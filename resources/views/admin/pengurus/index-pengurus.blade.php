@extends('admin.layout.main')

@section('title', 'Pengurus')
    
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
            <a href="{{ route('admin.pengurus.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Pengurus</a>
          </div>
        </li>
      </ol>
    </nav>
  </div>

  
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Pengurus</h1>
  </div>
  
  @if (session('success'))
      <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
          <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
          <span class="sr-only">Info</span>
          <div>
              <span class="font-medium">{{ session('success') }}</span>
          </div>
      </div>
  @endif

  {{-- <div>
    <table id="search-table">
      <thead>
          <tr>
              <th>
                  <span class="flex items-center text-[#6DA854]">
                      No
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Nama
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Telepon
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Email
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Posisi
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Jabatan
                  </span>
              </th>
              <th>
                  <span class="flex items-center">
                      Action
                  </span>
              </th>
          </tr>
      </thead>
      <tbody>
        @forelse ($users as $index => $user) 
        <tr>
            <td class="font-medium text-gray-900 whitespace-nowrap">{{$index + 1}}</td>
            <td>{{$user->nama}}</td>
            <td>{{$user->telepon}}</td>
            <td>{{$user->email}}</td>
            <td>
              @if($user->posisi == 'anggota')
                  Anggota
              @elseif($user->posisi == 'pengurus')
                  Pengurus
              @endif
            </td>
            <td>
              @if($user->jabatan == 'pengawas')
                  Pengawas
              @elseif($user->jabatan == 'bendahara')
                  Bendahara
              @endif
            </td>
            <td class="flex">
              <a href="{{ route('admin.pengurus.edit', $user->id) }}">
                  <button class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 ml-2">
                    Edit
                  </button>
              </a>
              <button 
                  class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2"
                  onclick="confirmDelete({{ $user->id }})">
                    Hapus
              </button>
              <form id="delete-form-{{ $user->id }}" action="{{ route('admin.pengurus.destroy', $user->id) }}" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
              </form>
            </td>
        </tr>
        @empty
                      
        @endforelse
      </tbody>
    </table>
  </div> --}}
  @livewire('pengurus-filter')
</div>
@endsection

@push('scripts')
  <script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
      const dataTable = new simpleDatatables.DataTable("#search-table", {
          searchable: true,
          sortable: false
      });
    }

    function confirmDelete(userId) {
          Swal.fire({
              title: 'Apakah Anda yakin?',
              text: "Data pengurus akan dihapus secara permanen!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#166534',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  $(`#delete-form-${userId}`).submit();
              }
          })
    }
  </script>
@endpush