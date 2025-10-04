@php
    $admin = auth()->guard('admin')->check();
    $pengurus = auth()->guard('pengurus')->check() && auth()->guard('pengurus')->user()->jabatan === 'sekretaris';
    
    if ($admin) {
        $storeRoute = route('admin.anggota.update', $user->id);
    } elseif ($pengurus) {
        $storeRoute = route('pengurus.anggota.update', $user->id);
    }
@endphp

<div>
    <form action="{{ $storeRoute }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                No Anggota <span class="text-red-500">*</span>
            </label>
            <input wire:model.live="no_anggota" type="text" id="no_anggota" name="no_anggota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan No Anggota" value="{{ old('no_anggota', $user->no_anggota) }}" required inputmode="numeric" pattern="\d*"/>
            @error('no_anggota')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_no_anggota }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Nama <span class="text-red-500">*</span>
            </label>
            <input wire:model.live="nama" type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nama" value="{{ old('nama') }}" required/>
            <p class="text-red-500 text-xs mt-1">{{ $error_nama }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Jenis Pegawai <span class="text-red-500">*</span>
            </label>
            <select id="jenis_pegawai" name="jenis_pegawai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                <option value="">Pilih Jenis Pegawai</option>
                @foreach ($jenisPegawaiOptions as $jenis_pegawai)
                    <option value="{{ $jenis_pegawai }}" {{ old('jenis_pegawai', $user->jenis_pegawai) == $jenis_pegawai ? 'selected' : '' }}>{{ $jenis_pegawai }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nomor Telepon</label>
            <input wire:model.live="telepon" type="text" id="telepon" name="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan No. Telepon" inputmode="numeric" pattern="[0-9]*" value="{{ old('telepon', $user->telepon) }}"/>
            @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_telepon }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
            <input wire:model.live="email" type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Email" value="{{ old('email', $user->email) }}"/>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_email }}</p>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Password <span class="text-red-500">*</span>
            </label>
            <input wire:model.live="password" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Password" value=""/>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_password }}</p>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if ($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
<script>
    document.getElementById('telepon').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('no_anggota').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
