{{-- <div>
    <form action="">
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <select id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                <option value="" disabled {{ old('anggota_id') ? '' : 'selected' }}>Pilih Nama Anggota</option>
                @foreach($namaList as $id => $nama)
                    <option value="{{ $id }}" {{ old('anggota_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah Pinjaman</label>
            <input type="text" wire:model.lazy="jumlah_pinjaman" id="jumlah_pinjaman" name="jumlah_pinjaman" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('jumlah_pinjaman') }}" oninput="formatRupiah(this)"/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lama Angsuran</label>
            <select wire:model.lazy="lama_angsuran" name="lama_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                <option value="" disabled>Pilih Lama Angsuran</option>
                <option value="3 bulan">3 Bulan</option>
                <option value="6 bulan">6 Bulan</option>
                <option value="12 bulan">12 Bulan</option>
                <option value="24 bulan">24 Bulan</option>
                <option value="36 bulan">36 Bulan</option>
                <option value="48 bulan">48 Bulan</option>
                <option value="60 bulan">60 Bulan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Pokok</label>
            <input type="text" wire:model="nominal_pokok" id="nominal_pokok" name="nominal_pokok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('nominal_pokok') }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Bunga</label>
            <input type="text" wire:model="nominal_bunga" id="nominal_bunga" name="nominal_bunga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('nominal_bunga') }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Angsuran</label>
            <input type="text" wire:model="nominal_angsuran" id="nominal_angsuran" name="nominal_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('nominal_angsuran') }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Admin</label>
            <input type="text" wire:model="biaya_admin" id="biaya_admin" name="biaya_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('biaya_admin') }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Uang Yang Diterima</label>
            <input type="text" wire:model="total_pinjaman" id="total_pinjaman" name="total_pinjaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('total_pinjaman') }}" readonly/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
                Simpan
            </button>
        </div>
    </form>
</div> --}}

<div>
    <form action="{{ route('pengurus.pinjaman.store') }}" method="POST">   
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="pengurus_id" value="{{ auth()->guard('pengurus')->user()->id }}" hidden>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
                <select id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    <option value="" disabled {{ old('anggota_id') ? '' : 'selected' }}>Pilih Nama Anggota</option>
                    @foreach($namaList as $id => $nama)
                        <option value="{{ $id }}" {{ old('anggota_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Lama Angsuran</label>
                <select wire:model.lazy="lama_angsuran" name="lama_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    <option value="" disabled>Pilih Lama Angsuran</option>
                    <option value="3 bulan">3 Bulan</option>
                    <option value="6 bulan">6 Bulan</option>
                    <option value="12 bulan">12 Bulan</option>
                    <option value="24 bulan">24 Bulan</option>
                    <option value="36 bulan">36 Bulan</option>
                    <option value="48 bulan">48 Bulan</option>
                    <option value="60 bulan">60 Bulan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah Pinjaman</label>
                <input type="text" wire:model.live="jumlah_pinjaman" id="jumlah_pinjaman" name="jumlah_pinjaman" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('jumlah_pinjaman') }}" oninput="formatRupiah(this)"/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Pokok</label>
                <input type="text" wire:model="nominal_pokok" id="nominal_pokok" name="nominal_pokok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Pokok" inputmode="numeric" value="{{ old('nominal_pokok') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Biaya Admin</label>
                <input type="text" wire:model="biaya_admin" id="biaya_admin" name="biaya_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Biaya Admin" inputmode="numeric" value="{{ old('biaya_admin') }}" readonly/>
            </div>
            <div class="mb-3">
                <label class="block mb-1 text-sm font-medium text-gray-900">Nominal Bunga</label>
                <input type="text" wire:model="nominal_bunga" id="nominal_bunga" name="nominal_bunga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Bunga" inputmode="numeric" value="{{ old('nominal_bunga') }}" readonly/>
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
                <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
