<div>
  <form id="angsuranForm" action="{{ route('admin.angsuran-unit-konsumsi.update', $angsuran->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="block mb-1 text-sm font-medium text-gray-900">Tanggal</label>
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
        <label class="block mb-1 text-sm font-medium text-gray-900">Angsuran</label>
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
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
        <select name="jasa" id="jasa_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" onchange="toggleManualJasaInput(this)">
            <option value="{{ $jasa }}">{{ $jasa }}</option>
            <option value="">Masukan Manual</option>            
        </select>
        <div id="manual_input_jasa_container" class="hidden mt-4">
            <input type="text" name="jasa_manual" class="format-rupiah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" placeholder="Masukan Nominal Jasa" value="{{ old('jasa')}}" inputmode="numeric"/>
        </div>
    </div>
    <div class="flex justify-start">
      <button id="submit-btn" type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if ($disabled) disabled @endif> 
          Simpan
      </button>
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
