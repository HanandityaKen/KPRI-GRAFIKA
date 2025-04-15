@extends('anggota.layout.main')

@section('title', 'Profil')

@section('content')
    <div class="mb-10">
        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Header -->
            <header class="bg-green-100 text-green-700 w-full">
            <div class="max-w-none px-6 py-16 md:py-20 lg:py-24 text-center">
                <h1 class="text-xl lg:text-2xl font-semibold">Profile</h1>
            </div>
            </header>

            @if (session('success'))
            <div class="px-20">
                <div class="flex items-center p-4 mb-6 mt-8 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
            @endif
    
            <!-- Konten -->
            <div class="px-20 sm:px-10 lg:px-20 mt-10 mb-10">
                <div class="flex flex-col items-center gap-5 text-center">
                    <div class="w-44 sm:w-56">
                        <!-- Gambar Profil -->
                        <img id="previewImage" src="{{ $anggota->foto_profile ? asset('storage/' . $anggota->foto_profile) : asset('storage/assets/default-avatar.webp') }}"  class="w-40 h-40 sm:w-50 sm:h-50 rounded-full object-cover aspect-square mx-auto" alt="Avatar" />
                    </div>
                    
                    <!-- Input Gambar -->
                    <div class="flex flex-row gap-2 mt-2">
                        <label class="px-4 py-2 bg-green-800 rounded-md text-center text-white text-sm cursor-pointer">
                            Change
                            <input type="file" id="fotoInput" name="foto_profile" accept="image/*" class="hidden">
                        </label>  
                        <button type="button" id="deleteImage" class="p-3 py-2 bg-red-500 rounded-md text-center text-white text-sm">
                            Delete
                        </button>
                    </div>
                </div>
        
                <input type="hidden" name="delete_foto" id="delete_foto" value="0">
            </div>
    
            <!-- Personal Data Section -->
            @livewire('anggota.form-profile', ['id' => $anggota->id])
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        const fileInput = document.getElementById('fotoInput');
        const previewImage = document.getElementById('previewImage');
        const deleteImage = document.getElementById('deleteImage');
        const deleteFotoInput = document.getElementById('delete_foto'); // Dapatkan elemen hidden

        const defaultImage = "{{ asset('storage/assets/default-avatar.webp') }}"; 

        // Saat memilih file, reset input hidden agar foto tidak dihapus
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
                deleteFotoInput.value = "0"; // Pastikan foto tidak dihapus jika memilih file baru
            }
        });

        // Saat tombol hapus ditekan, atur foto ke default dan tandai untuk dihapus
        deleteImage.addEventListener('click', function() {
            previewImage.src = defaultImage;
            fileInput.value = ''; // Reset input file
            deleteFotoInput.value = "1"; // Tandai untuk menghapus foto saat form dikirim
        });
    </script>
@endpush