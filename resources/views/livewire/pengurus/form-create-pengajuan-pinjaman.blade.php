<div>
    <form action="{{ route('pengurus.pengajuan-pinjaman.store') }}" method="POST">   
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="requested_by" value="{{ auth()->guard('pengurus')->user()->nama }}" hidden>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                <div wire:ignore>
                    <select wire:model.lazy="anggota_id" id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                        <option value="" disabled {{ old('anggota_id') ? '' : 'selected' }}>Pilih Nama Anggota</option>
                        @foreach($namaList as $id => $nama)
                            <option value="{{ $id }}" {{ old('anggota_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="text-red-500 text-xs mt-1">{{ $error_proses_pengajuan_pinjaman }}</p>
                @if($pinjamanAktif)
                    <p class="text-red-500 text-xs mt-1">* Anggota ini memiliki angsuran yang belum selesai.</p>
                @endif
            </div>
            @if ($pinjamanAktif)
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Kurang Angsuran</label>
                    <input type="text" wire:model="kurangAngsuran" id="kurang_angsuran" name="kurang_angsuran" class="format-bulan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Kurang Angsuran" inputmode="numeric" readonly/>
                </div>
            @endif
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah Pinjaman</label>
                <input type="text" wire:model.live="jumlah_pinjaman" id="jumlah_pinjaman" name="jumlah_pinjaman" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pinjaman" inputmode="numeric" value="{{ old('jumlah_pinjaman') }}" oninput="formatRupiah(this)" required/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Lama Angsuran (Kali/Bulan)</label>
                <input type="text" wire:model.live="lama_angsuran" id="lama_angsuran" name="lama_angsuran" class="format-bulan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Lama Angsuran" inputmode="numeric" value="{{ old('lama_angsuran') }}" required/>
                <p class="text-red-500 text-xs mt-1">{{ $error_lama_angsuran }}</p>
            </div>
            @if ($pinjamanAktif)     
                <div class="mb-3">
                    <label class="block mb-1 text-sm font-medium text-gray-900">Kompen</label>
                    <input type="text" wire:model="kompen" id="kompen" name="kompen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Kompen" inputmode="numeric" value="{{ old('kompen') }}" readonly/>
                </div>
            @endif
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Pokok</label>
                <input type="text" wire:model="nominal_pokok" id="nominal_pokok" name="nominal_pokok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Pokok" inputmode="numeric" value="{{ old('nominal_pokok') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Admin</label>
                <input type="text" wire:model="biaya_admin" id="biaya_admin" name="biaya_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Biaya Admin" inputmode="numeric" value="{{ old('biaya_admin') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Jasa</label>
                <input type="text" wire:model="nominal_bunga" id="nominal_bunga" name="nominal_bunga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Jasa" inputmode="numeric" value="{{ old('nominal_bunga') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Uang Yang Diterima</label>
                <input type="text" wire:model="total_pinjaman" id="total_pinjaman" name="total_pinjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Uang Yang Diterima" inputmode="numeric" value="{{ old('total_pinjaman') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Angsuran</label>
                <input type="text" wire:model="nominal_angsuran" id="nominal_angsuran" name="nominal_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Angsuran" inputmode="numeric" value="{{ old('nominal_angsuran') }}" readonly/>
            </div>
            <div class="flex justify-start">
                <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md"  @if($disabled) disabled @endif>
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
