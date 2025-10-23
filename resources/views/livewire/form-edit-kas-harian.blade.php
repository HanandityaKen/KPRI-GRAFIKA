<div>
    <form action="{{ route('admin.kas-harian.update', $kasHarian->id) }}" id="formCreateJkm" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" disabled>
                <option selected disabled>Pilih Jenis Transaksi</option>
                <option value="kas masuk" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas masuk' ? 'selected' : '' }}>Kas Masuk</option>
                <option value="kas keluar" {{ old('jenis_transaksi', $kasHarian->jenis_transaksi) == 'kas keluar' ? 'selected' : '' }}>Kas Keluar</option>
            </select>
            <input type="hidden" name="jenis_transaksi" value="{{ old('jenis_transaksi', $kasHarian->jenis_transaksi) }}">
        </div>
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
                <input id="datepicker-kas-masuk" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::parse($kasHarian->tanggal)->format('d-m-Y')) }}"  placeholder="Pilih Tanggal" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Nama <span class="text-red-500">*</span>
            </label>
            <div wire:ignore>
                <select disabled wire:model.lazy="anggota_id" id="select_nama_kas_masuk" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
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
            <label class="block mb-1 text-sm font-medium text-gray-900">Pokok</label>
            <input wire:model="pokok" type="text" id="pokok" name="pokok" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Pokok" inputmode="numeric" value="{{ old('pokok', $kasHarian->pokok) }}" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib</label>
            <select wire:model.live="selectedWajib" name="wajib" id="wajib" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualInputWajib(this)">
                @foreach($wajibOptions as $wajibOption)
                    @if ($wajib != $wajibOption)
                        <option value="{{ $wajib }}">Rp {{ number_format($wajib, 0, ',', '.') }}</option>
                    @endif
                    <option value="{{ $wajibOption }}" {{ old('wajib', $kasHarian->wajib) == $wajibOption ? 'selected' : '' }}>
                        Rp {{ number_format($wajibOption, 0, ',', '.') }}
                    </option>
                @endforeach
                <option value="manual">Masukan Manual</option>
            </select>
            <div wire:ignore id="manual_input_wajib" class="hidden mt-4">
                <input wire:model.live="wajibManual" type="text" name="wajib_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Wajib" value="{{ old('wajib')}}" inputmode="numeric"/>
            </div>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Manasuka</label>
            <input wire:model.live="manasuka" type="text" id="manasuka" name="manasuka" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Manasuka" inputmode="numeric" value="{{ old('manasuka', $kasHarian->manasuka) }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Wajib Pinjam</label>
            <select wire:model.live="selectedWajibPinjam" name="wajib_pinjam" id="wajib_pinjam" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualInputWajibPinjam(this)">
                @if (!in_array($wajibPinjam, $wajibPinjamList))
                    <option value="{{ $wajibPinjam }}">Rp {{ number_format($wajibPinjam, 0, ',', '.') }}</option>
                @endif
                @foreach ($wajibPinjamList as $id => $nominal)
                    <option value="{{ $nominal }}" {{ old('wajib_pinjam', $kasHarian->wajib_pinjam) == $nominal ? 'selected' : '' }}>
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
            <input wire:model.live="qurban" type="text" id="qurban" name="qurban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Qurban" inputmode="numeric" value="{{ old('qurban', $kasHarian->qurban) }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Lain-Lain</label>
            <input wire:model.live="lain_lain" type="text" id="lain_lain" name="lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Lain-Lain" inputmode="numeric" value="{{ old('lain_lain', $kasHarian->lain_lain) }}" />
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Keterangan <span class="text-red-500">*</span>
            </label>
            <input type="text" name="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Keterangan" value="{{ old('keterangan', $kasHarian->keterangan) }}" required/>
        </div>
        <div class="flex justify-start">
            <button data-modal-target="modal-pengurus-kas-masuk" data-modal-toggle="modal-pengurus-kas-masuk" onclick="initTomSelectPengurusUpdateKasMasuk()" class="bg-green-800 text-white py-2 px-4 rounded-md" @if($disabled) disabled @endif>
                Simpan
            </button>

            <div id="modal-pengurus-kas-masuk" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full min-h-screen bg-gray-900 bg-opacity-40">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-xl">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-5 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Diedit Oleh
                            </h3>
                            <button type="button" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modal-pengurus-kas-masuk">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block mb-2 text-sm text-left font-medium text-gray-700">Diedit Oleh</label>
                                <select wire:model.live="select_pengurus" id="select_pengurus_kas_masuk" name="updated_by" class="text-left bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition duration-200" required>
                                    <option value="" disabled selected>Pilih Nama</option>
                                    @foreach ($anggotaList as $id => $nama)
                                        <option value="{{ $nama }}" {{ old('anggota_id') == $nama ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 pt-0 space-x-3 border-t border-gray-200 rounded-b">
                            <div class="mt-3">
                                <button data-modal-hide="modal-pengurus-kas-masuk" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:outline-none transition duration-200">
                                    Batal
                                </button>
                                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-green-800 hover:bg-green-900 rounded-lg transition duration-200">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
@push('scripts')
    <script>
        function initTomSelectPengurusUpdateKasMasuk() {
            new TomSelect("#select_pengurus_kas_masuk", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        }
    </script>
@endpush

