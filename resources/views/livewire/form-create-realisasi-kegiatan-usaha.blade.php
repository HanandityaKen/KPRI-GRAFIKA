<div>
    <form action="{{ route('admin.shu.store-realisasi-kegiatan-usaha') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">
                Tahun <span class="text-red-500">*</span>
            </label>
            <input type="number" wire:model.live="tahun" id="tahun" name="tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah Beban" inputmode="numeric" min="2020" value="{{ old('tahun', \Carbon\Carbon::now()->format('Y')) }}" required/>
            <p class="text-red-500 text-xs mt-1">{{ $errorMessageTahun }}</p>
        </div>
        <div id="accordion-collapse" data-accordion="open">
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-2">
                    <button type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 rounded-t-lg border border-gray-200 bg-gray-100 transition-all duration-200" 
                        data-accordion-target="" 
                        aria-expanded="true" 
                        aria-controls="">
                        <span class="flex items-center text-sm text-gray-900">
                            Pendapatan
                        </span>
                    </button>
                </h2>
                <div id="" class="" aria-labelledby="accordion-collapse-heading-2">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa dari Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="jasa_dari_anggota" id="jasa_dari_anggota" name="jasa_dari_anggota" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Anggota" inputmode="numeric" value="{{ old('jasa_dari_anggota') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Unit Konsumsi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="unit_konsumsi" id="unit_konsumsi" name="unit_konsumsi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Unit Konsumsi" inputmode="numeric" value="{{ old('unit_konsumsi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa SKPB <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="jasa_skpb" id="jasa_skpb" name="jasa_skpb" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa SKPB" inputmode="numeric" value="{{ old('jasa_skpb') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Administrasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="jasa_administrasi" id="jasa_administrasi" name="jasa_administrasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Administrasi" inputmode="numeric" value="{{ old('jasa_administrasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    SHU KPRI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="shu_kpri" id="shu_kpri" name="shu_kpri" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal SHU KPRI" inputmode="numeric" value="{{ old('shu_kpri') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Sewa Rumah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="sewa_rumah" id="sewa_rumah" name="sewa_rumah" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Sewa Rumah" inputmode="numeric" value="{{ old('sewa_rumah') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Tanah Kopling <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="jasa_tanah_kopling" id="jasa_tanah_kopling" name="jasa_tanah_kopling" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Tanah Kopling" inputmode="numeric" value="{{ old('jasa_tanah_kopling') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Jasa Lain-Lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="jasa_tanah_lain_lain" id="jasa_tanah_lain_lain" name="jasa_tanah_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa Tanah Lain-Lain" inputmode="numeric" value="{{ old('jasa_tanah_lain_lain') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah Pendapatan</label>
                            <input type="text" wire:model="jumlah_pendapatan" id="jumlah_pendapatan" name="jumlah_pendapatan" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah Pendapatan" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-lg">
                <h2 id="accordion-collapse-heading-2">
                    <button type="button" 
                        class="flex items-center justify-between w-full p-2 font-medium text-left text-gray-900 border border-gray-200 bg-gray-100 transition-all duration-200" 
                        data-accordion-target="" 
                        aria-expanded="true" 
                        aria-controls="">
                        <span class="flex items-center text-sm text-gray-900">
                            Beban
                        </span>
                    </button>
                </h2>
                <div id="" class="" aria-labelledby="accordion-collapse-heading-2">
                    <div class="p-5 border border-t-0 border-gray-200 bg-white">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Organisasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="beban_organisasi" id="beban_organisasi" name="beban_organisasi" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Organisasi" inputmode="numeric" value="{{ old('beban_organisasi') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Operasional <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="beban_operasional" id="beban_operasional" name="beban_operasional" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Operasional" inputmode="numeric" value="{{ old('beban_operasional') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Umum <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="beban_umum" id="beban_umum" name="beban_umum" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Umum" inputmode="numeric" value="{{ old('beban_umum') }}" required/>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900">
                                    Beban Lain-Lain <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model.live="beban_lain_lain" id="beban_lain_lain" name="beban_lain_lain" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Beban Lain-Lain" inputmode="numeric" value="{{ old('beban_lain_lain') }}" required/>
                            </div>
                        </div>
                        <hr class="mt-4 my-2 border-t-[1px] border-green-800 opacity-20">
                        <div class="mt-4">
                            <label class="block mb-1 text-sm font-medium text-gray-900">Jumlah Beban</label>
                            <input type="text" wire:model="jumlah_beban" id="jumlah_beban" name="jumlah_beban" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah Beban" inputmode="numeric" value="" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 mt-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Sisa Hasil Usaha Sebelum Pajak</label>
            <input type="text" wire:model.live="shu_sebelum_pajak" id="shu_sebelum_pajak" name="shu_sebelum_pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Jumlah Sisa Hasil Usaha Sebelum Pajak" inputmode="numeric" value="" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-900">Pajak</label>
            <input type="text" wire:model.live="pajak" id="pajak" name="pajak" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Pajak" inputmode="numeric" value="" readonly/>
        </div>
        <div class="mb-4">
            <label class="block mb-1 text-sm font-bold text-gray-900">Sisa Hasil Usaha</label>
            <input type="text" wire:model.live="shu" id="shu" name="shu" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Nominal Sisa Hasil Usaha" inputmode="numeric" value="" readonly/>
            <p class="text-red-500 text-xs mt-1">{{ $errorMessage }}</p>
        </div>
        <div class="flex justify-start">
            <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if ($disabled) disabled @endif>
                Simpan
            </button>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#datepicker", {
                dateFormat: "d-m-Y",
                allowInput: true,
                position: "below",
                locale: "id"
            });
        });

        document.body.addEventListener("input", function (e) {
            if (e.target.classList.contains("format-rupiah")) {
                let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
                let formatted = new Intl.NumberFormat("id-ID").format(value);
                e.target.value = value ? `Rp ${formatted}` : "";
            }
        });
        
    </script>
@endpush
