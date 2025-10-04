<div>
    <form action="{{ route('admin.kas-harian.store') }}" id="formCreateJkm" method="POST">
        @csrf
        <input type="text" name="jenis_transaksi" class="hidden"  value="kas masuk"/>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Tanggal <span class="text-red-500">*</span>
            </label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-kas-masuk" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Nama <span class="text-red-500">*</span>
            </label>
            <div wire:ignore>
                <select wire:model.lazy="anggota_id" id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    <option value="" disabled {{ old('nama') ? '' : 'selected' }}>Pilih Nama Anggota</option>
                    @foreach($namaList as $id => $nama)
                        <option value="{{ $id }}" {{ old('nama') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
            <input wire:model="pokok" type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('pokok') }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
            <select wire:model.live="wajib" name="wajib" id="wajib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualInputWajib(this)">
                <option value="" selected>Pilih Nominal</option>
                @foreach($wajibOptions as $option)
                    <option value="{{ $option }}">Rp {{ number_format($option, 0, ',', '.') }}</option>
                @endforeach
                <option value="manual">Masukan Manual</option>            
            </select>
            <div wire:ignore id="manual_input_wajib" class="hidden mt-4">
                <input wire:model.live="wajibManual" type="text" name="wajib_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib" value="{{ old('wajib')}}" inputmode="numeric"/>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
            <input wire:model.live="manasuka" type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka') }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
            <select wire:model.live="wajibPinjam" name="wajib_pinjam" id="wajib_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualInputWajibPinjam(this)">
                <option value="">Rp 0</option>
                @foreach ($wajibPinjamList as $id => $nominal)
                    <option value="{{ $nominal }}" {{ old('wajib_pinjam') == $nominal ? 'selected' : '' }}>
                        Rp {{ number_format($nominal, 0, ',', '.') }}
                    </option>
                @endforeach
                <option value="manual">Masukan Manual</option>            
            </select>         
            <div wire:ignore id="manual_input_wajib_pinjam" class="hidden mt-4">
                <input wire:model.live="wajibPinjamManual" type="text" name="wajib_pinjam_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib" value="{{ old('wajib_pinjam')}}" inputmode="numeric"/>
            </div>   
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
            <input wire:model.live="qurban" type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban') }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
            <input wire:model.live="lain_lain" type="text" id="lain-lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain-lain') }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Keterangan <span class="text-red-500">*</span>
            </label>
            <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan') }}" required/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
<script>
    function toggleManualInputWajib(select) {
        const manualInputContainer = document.getElementById('manual_input_wajib');
        const manualInput = manualInputContainer.querySelector('input');

        if (select.value === 'manual') {
            manualInputContainer.classList.remove('hidden');
        } else {
            manualInputContainer.classList.add('hidden');
            manualInput.value = ''; // Hapus isi input manual saat disembunyikan
        }
    }

    function toggleManualInputWajibPinjam(select) {
        const manualInputContainer = document.getElementById('manual_input_wajib_pinjam');
        const manualInput = manualInputContainer.querySelector('input');

        if (select.value === 'manual') {
            manualInputContainer.classList.remove('hidden');
        } else {
            manualInputContainer.classList.add('hidden');
            manualInput.value = ''; // Hapus isi input manual saat disembunyikan
        }
    }
</script>
