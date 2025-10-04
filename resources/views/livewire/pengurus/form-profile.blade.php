<div>
    <h1 class="text-xl font-bold mb-4">Personal Data</h1>
    <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-900">
            Nama <span class="text-red-500">*</span>
        </label>
        <input wire:model.live="nama" type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('nama') }}" required/>
        <p class="text-red-500 text-xs mt-1">{{ $error_nama }}</p>
    </div>
    <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-900">Telepon</label>
        <input wire:model.live="telepon" type="text" name="telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('telepon') }}" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
        <p class="text-red-500 text-xs mt-1">{{ $error_telepon }}</p>
    </div>
    <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
        <input wire:model.live="email" type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ old('email') }}"/>
        <p class="text-red-500 text-xs mt-1">{{ $error_email }}</p>
    </div>
    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Password</label>
        <input wire:model.live="password" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" />
        <p class="text-red-500 text-xs mt-1">{{ $error_password }}</p>
    </div>
    <div class="flex justify-start">
        <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if ($disabled) disabled @endif>
            Simpan
        </button>
    </div>
</div>
