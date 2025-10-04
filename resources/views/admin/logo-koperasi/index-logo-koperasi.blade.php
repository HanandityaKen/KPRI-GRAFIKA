@extends('admin.layout.main')

@section('title', 'Logo Koperasi')

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
              <a href="{{ route('admin.logo-koperasi-index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ms-2">Logo Koperasi</a>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-xl font-bold">Logo Koperasi</h1>
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
      <form action="{{ route('admin.logo-koperasi-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
          <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
              Logo Koperasi <span class="text-red-500">*</span>
            </label>
            <!-- Preview Container -->
            <div id="previewContainer" class="hidden mt-3 mb-4">
              <img id="previewImage" src="#" alt="Preview Logo" class="w-32 h-32 object-contain border rounded" />
            </div>
            <input type="file" accept=".svg, .png, .jpg, .jpeg" id="logo_koperasi" name="logo_koperasi"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2"
              required onchange="previewLogo(event)" />
            <p class="mt-1 ml-1 text-sm text-gray-500" id="foto_koperasi">SVG, PNG, JPG (max 2MB).</p>
          </div>
    
          <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
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
    function previewLogo(event) {
      const input = event.target;
      const preview = document.getElementById('previewImage');
      const container = document.getElementById('previewContainer');

      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          preview.src = e.target.result;
          container.classList.remove('hidden');
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endpush