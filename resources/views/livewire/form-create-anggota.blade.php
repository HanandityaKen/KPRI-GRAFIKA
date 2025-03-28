<div>
    <form action="{{ route('admin.anggota.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">No Anggota</label>
            <input wire:model.live="no_anggota" type="text" id="no_anggota" name="no_anggota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('no_anggota') }}" placeholder="Masukan No Anggota" inputmode="numeric" required/>
            @error('no_anggota')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_no_anggota }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <input wire:model.live="nama" type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nama') }}" placeholder="Masukan Nama" required/>
            <p class="text-red-500 text-xs mt-1">{{ $error_nama }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Pegawai</label>
            <select id="jenis_pegawai" name="jenis_pegawai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                <option value="">Pilih Jenis Pegawai</option>
                <option value="PNS" {{ old('jenis_pegawai') == 'PNS' ? 'selected' : '' }}>PNS</option>
                <option value="P3K" {{ old('jenis_pegawai') == 'P3K' ? 'selected' : '' }}>P3K</option>
                <option value="GTT" {{ old('jenis_pegawai') == 'GTT' ? 'selected' : '' }}>GTT</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Posisi</label>
            <select disabled id="posisi" name="posisi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                <option selected value="anggota">Anggota</option>
            </select>
            <input type="hidden" name="posisi" value="anggota">
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nomor Telepon</label>
            <input wire:model.live="telepon" type="text" id="telepon" name="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" inputmode="numeric" pattern="[0-9]*" value="{{ old('telepon') }}" placeholder="Masukan No. Telepon" required/>
            @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_telepon }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
            <input wire:model.live="email" type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('email') }}" placeholder="Masukan Email" required/>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-red-500 text-xs mt-1">{{ $error_email }}</p>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium text-gray-900">Password</label>
            <input wire:model.live="password" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Password" required/>
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
