<div>
    <form action="{{ route('pengurus.kas-harian.update', $kasHarian->id) }}" id="formCreateJkk" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" disabled>
                <option selected disabled>Pilih Jenis Transaksi</option>
                <option value="kas masuk" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
                <option value="kas keluar" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
                <input type="hidden" name="jenis_transaksi" value="{{ old('jenis_transaksi', $kasHarian->jenis_transaksi) }}">
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input id="datepicker-kas-keluar" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::parse($kasHarian->tanggal)->format('d-m-Y')) }}"  placeholder="Pilih Tanggal" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nama</label>
            <div wire:ignore>
                <select disabled wire:model.lazy="anggota_id" id="select_nama_kas_keluar" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    <option value="" disabled>Pilih Nama Anggota</option>

                    {{-- Tampilkan opsi nama_anggota dari kasHarian jika tidak ada di namaList --}}
                    @if(!array_key_exists($kasHarian->anggota_id, $namaList))
                        <option value="{{ $kasHarian->anggota_id }}" selected>{{ $kasHarian->nama_anggota }}</option>
                    @endif

                    @foreach($namaList as $id => $nama)
                        <option value="{{ $id }}" {{ old('nama', $kasHarian->anggota_id) == $id ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="anggota_id" value="{{ $kasHarian->anggota_id }}">
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
            <select wire:model.live="selectedWajib" name="wajib" id="wajib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                @foreach($wajibOption as $wajib)
                    <option value="{{ $wajib }}" {{ old('wajib', $kasHarian->wajib) == $wajib ? 'selected' : '' }}>
                        Rp {{ number_format($wajib, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
            <input wire:model.live="manasuka" type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka') }}" />
            <p class="text-red-500 text-xs mt-1">{{ $error_manasuka }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Qurban</label>
            <input wire:model.live="qurban" type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban') }}" />
            <p class="text-red-500 text-xs mt-1">{{ $error_qurban }}</p>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
            <input wire:model.live="lain_lain" type="text" id="lain_lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain_lain', $kasHarian->lain_lain) }}" />
        </div>
        @if ($bendahara)       
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Beban Umum</label>
                <input wire:model.live="b_umum" type="text" id="b_umum" name="b_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('b_umum', $kasHarian->b_umum) }}" />
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Beban Organisasi</label>
                <input wire:model.live="b_orgns" type="text" id="b_orgns" name="b_orgns" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('b_orgns', $kasHarian->b_orgns) }}" />
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Beban Operasional</label>
                <input wire:model.live="b_oprs" type="text" id="b_oprs" name="b_oprs" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('b_oprs', $kasHarian->b_oprs) }}" />
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Beban Lain</label>
                <input wire:model.live="b_lain" type="text" id="b_lain" name="b_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain" inputmode="numeric" value="{{ old('b_lain', $kasHarian->b_lain) }}" />
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-900">Tanah Kavling</label>
                <input wire:model.live="tnh_kav" type="text" id="tnh_kav" name="tnh_kav" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Tanah Kavling" inputmode="numeric" value="{{ old('tnh_kav', $kasHarian->tnh_kav) }}" />
            </div>
        @endif
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Keterangan</label>
            <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan', $kasHarian->keterangan) }}"/>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
