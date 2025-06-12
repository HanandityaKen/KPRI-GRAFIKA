<div>
  <form action="{{ route('pengurus.angsuran-unit-konsumsi.update', $angsuran->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
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

            {{-- @if ($angsuran->tunggakan > 0)
              <option value="{{ $angsuran->kurang_angsuran }}" {{ old('angsuran', $angsuran->angsuran) == $angsuran->kurang_angsuran ? 'selected' : '' }}>
                  Rp {{ number_format($angsuran->kurang_angsuran, 0, ',', '.') }}
              </option>
            @endif --}}
            
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
    <div class="mb-4">
        <label class="block mb-1 text-sm font-medium text-gray-900">Jasa</label>
        <input wire:model="jasa" type="text" name="jasa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" readonly/>
    </div>
    <div class="flex justify-start">
      <button type="submit" class="bg-green-800 text-white py-2 px-4 rounded-md" @if ($disabled) disabled @endif>
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
</script>
