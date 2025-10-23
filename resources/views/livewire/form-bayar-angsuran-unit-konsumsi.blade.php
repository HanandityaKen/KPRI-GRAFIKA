<div>
  <form id="angsuranForm" action="{{ route('admin.angsuran-unit-konsumsi.update', $angsuran->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-900">
          Tanggal <span class="text-red-500">*</span>
        </label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input wire:model.live="tanggal" id="datepicker-bayar-unit-konsumsi" name="tanggal" type="text" class="tanggal bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5" value="{{ old('tanggal', \Carbon\Carbon::now()->format('d-m-Y')) }}" placeholder="Pilih Tanggal" required>
        </div>
    </div>
    <div class="mb-4">
      <label class="block mb-1 text-sm font-medium text-gray-900">Nama Anggota</label>
      <input type="text" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500   focus:border-green-500 block w-full p-2" value="{{ old('nama', $angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nama_anggota) }}" readonly/>
      <input type="hidden" name="anggota_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500   focus:border-green-500 block w-full p-2" value="{{ old('anggota_id', $angsuran->unit_konsumsi->pengajuan_unit_konsumsi->anggota_id) }}" readonly/>
    </div>
    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Kurang Angsuran</label>
        <input type="text" name="kurang_angsuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ 'Rp ' . number_format($angsuran->kurang_angsuran, 0, ',', '.') }}" readonly/>
    </div>
    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Tunggakan</label>
        <input type="text" name="tunggakan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" value="{{ 'Rp ' . number_format($angsuran->tunggakan, 0, ',', '.') }}" readonly/>
    </div>
    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">
          Angsuran <span class="text-red-500">*</span>
        </label>
        <div wire:ignore>
          <select name="angsuran" id="angsuran_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualInput(this)">
            @if ($angsuran->kurang_angsuran < $angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok)
              <option value="{{ $angsuran->kurang_angsuran + $angsuran->tunggakan }}" {{ old('angsuran', $angsuran->angsuran) == $angsuran->kurang_angsuran + $angsuran->tunggakan ? 'selected' : '' }}>
                  Rp {{ number_format($angsuran->kurang_angsuran + $angsuran->tunggakan, 0, ',', '.') }}
              </option>
            @else
              <option value="{{ $angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok + $angsuran->tunggakan }}" {{ old('angsuran', $angsuran->angsuran) == ($angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok + $angsuran->tunggakan) ? 'selected' : '' }}>
                  Rp {{ number_format($angsuran->unit_konsumsi->pengajuan_unit_konsumsi->nominal_pokok + $angsuran->tunggakan, 0, ',', '.') }}
              </option>
            @endif

              <option value="0">Rp 0</option>
              <option value="">Masukan Manual</option>
          </select>
          @error('angsuran')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
          <div id="manual_input_container" class="hidden mt-4">
              <input wire:model.live="angsuranManual" type="text" name="angsuran_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Angsuran" value="{{ old('angsuran')}}" inputmode="numeric"/>
          </div>
        </div>
        <p class="text-red-500 text-xs mt-1">{{ $error_angsuran_manual }}</p>
    </div>
    {{-- <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
        <input wire:model="jasa" type="text" name="jasa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
    </div> --}}
    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">
          Jasa <span class="text-red-500">*</span>
        </label>
        <select name="jasa" id="jasa_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualJasaInput(this)">
            <option value="{{ $jasa }}">{{ $jasa }}</option>
            <option value="">Masukan Manual</option>
        </select>
        <div id="manual_input_jasa_container" class="hidden mt-4">
            <input type="text" name="jasa_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa" value="{{ old('jasa')}}" inputmode="numeric"/>
        </div>
    </div>
    <div class="flex justify-start">
      <button data-modal-target="modal-pengurus-angsuran-unit-konsumsi" data-modal-toggle="modal-pengurus-angsuran-unit-konsumsi" onclick="initTomSelectPengurusBayarAngsuranUnitKonsumsi()" class="bg-green-800 text-white py-2 px-4 rounded-md" @if ($disabled) disabled @endif>
          Simpan
      </button>

      <div id="modal-pengurus-angsuran-unit-konsumsi" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full min-h-screen bg-gray-900 bg-opacity-40">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-xl">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Dibuat Oleh
                    </h3>
                    <button type="button" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="modal-pengurus-angsuran-unit-konsumsi">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-2 text-sm text-left font-medium text-gray-700">Dibuat Oleh</label>
                        <select  id="select_pengurus_bayar_angsuran_unit_konsumsi" name="created_by" class="text-left bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 transition duration-200" required>
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
                        <button data-modal-hide="modal-pengurus-angsuran-unit-konsumsi" type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 border border-gray-300 rounded-lg focus:outline-none transition duration-200">
                            Batal
                        </button>
                        <button id="submit-btn" type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-green-800 hover:bg-green-900 rounded-lg transition duration-200">
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
  document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll('.format-rupiah').forEach(function (input) {
          let initialValue = input.value.replace(/\D/g, "");
          if (initialValue) {
              let formatted = new Intl.NumberFormat("id-ID").format(initialValue);
              input.value = `Rp ${formatted}`;
          }

          input.addEventListener("input", function (e) {
              let value = e.target.value.replace(/\D/g, "");
              let formatted = new Intl.NumberFormat("id-ID").format(value);
              e.target.value = value ? `Rp ${formatted}` : "";
          });
      });

      flatpickr("#datepicker-bayar-unit-konsumsi", {
          dateFormat: "d-m-Y",
          allowInput: true,
          position: "below",
          locale: "id"
      });

      const form = document.getElementById('angsuranForm');
      const submitBtn = document.getElementById('submit-btn');

      let formSubmitted = false;

      form.addEventListener('submit', function (e) {
          if (formSubmitted) {
              e.preventDefault();
              return;
          }

          e.preventDefault();
          formSubmitted = true;
          submitBtn.disabled = true;
          form.submit();
      });
  });

  function toggleManualInput(select) {
      const manualInputContainer = document.getElementById('manual_input_container');
      const manualInput = manualInputContainer.querySelector('input');

      if (select.value === '') {
          manualInputContainer.classList.remove('hidden');
      } else {
          manualInputContainer.classList.add('hidden');
          manualInput.value = ''; // Hapus isi input manual saat disembunyikan
          manualInput.dispatchEvent(new Event('input')); // trigger input event untuk memperbarui nilai livewire
      }
  }

  function toggleManualJasaInput(select) {
      const manualInputContainer = document.getElementById('manual_input_jasa_container');
      const manualInput = manualInputContainer.querySelector('input');

      if (select.value === '') {
          manualInputContainer.classList.remove('hidden');
      } else {
          manualInputContainer.classList.add('hidden');
          manualInput.value = ''; // Hapus isi input manual saat disembunyikan
      }
  }
</script>
@push('scripts')
  <script>
    function initTomSelectPengurusBayarAngsuranUnitKonsumsi() {
        setTimeout(() => {
            if (!document.querySelector('#select_pengurus_bayar_angsuran_unit_konsumsi').tomselect) {
                new TomSelect("#select_pengurus_bayar_angsuran_unit_konsumsi", {
                    create: false,
                    sortField: { field: "text", direction: "asc" },
                    openOnFocus: true,
                    maxOptions: 10,
                });
            }
        }, 0);
    }
  </script>
@endpush
