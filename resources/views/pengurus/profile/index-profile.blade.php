@extends('pengurus.layout.main')

@section('title', 'Profil')

@section('content')
    <div>
        <hr class="my-2 border-t-[2px] border-green-800 opacity-20 mb-5" />

        <h1 class="text-xl font-bold mb-4">Profile</h1>

        @if (session('success'))
            <div class="flex items-center p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pengurus.profile.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-5 mb-8">
                <div>
                    <!-- Gambar Profil -->
                    <img id="previewImage" src="{{ $pengurus->foto_profile ? asset('storage/' . $pengurus->foto_profile) : asset('storage/assets/default-avatar.webp') }}"  class="w-40 h-40 sm:w-50 sm:h-50 rounded-full object-cover aspect-square" alt="Avatar" />
                </div>
                
                <!-- Input Gambar -->
                <label class="p-3 py-2 bg-green-800 rounded-md text-center text-white text-sm cursor-pointer">
                    Change Picture
                    <input type="file" id="fotoInput" name="foto_profile" accept="image/*" class="hidden">
                </label>  
                <button type="button" id="deleteImage" class="p-3 py-2 bg-red-500 rounded-md text-center text-white text-sm">
                    Delete
                </button>
            </div>

            <input type="hidden" name="delete_foto" id="delete_foto" value="0">

            <h1 class="text-xl font-bold mb-4">Personal Data</h1>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ $pengurus->nama }}"/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Telepon</label>
                <input type="text" name="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ $pengurus->telepon }}" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ $pengurus->email }}"/>
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" />
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