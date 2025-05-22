<div class="w-56 bg-[#00B451] h-screen p-4 fixed-sidebar text-sm no-scrollbar">
  <!-- Logo and Brand -->
  <div class="flex items-center mt-2 mb-6">
    <img src="{{ asset('storage/logo-koperasi/' . $logoKoperasi->logo) }}" class="w-[40px] ml-1" alt="Logo" />
    <h2 class="font-bold text-lg text-white ml-3">{{ $namaKoperasi->nama}}</h2>
    <div class="flex flex-1 justify-end">
      <i data-lucide="menu" class="text-white group-hover:text-white cursor-pointer toggle2sidebar" onclick="toggleSidebar()"></i>
    </div>
  </div>

  <hr class="border-t-[1px] mb-4">

  <ul class="space-y-1 font-medium">
      <li>
          <a href="{{ route('pengurus.dashboard') }}"
              class="flex items-center p-2 text-white rounded-lg hover:bg-[#009348] group {{ Request::is('pengurus/dashboard') ? 'bg-[#009348]' : '' }}">
              <i data-lucide="layout-dashboard" class="text-white mr-3 group-hover:text-white"></i>
              <span class="font-medium group-hover:text-white">Dashboard</span>
          </a>
      </li>
      <li>
          <button type="button"
              class="flex items-center w-full p-2 text-white mb-1 transition duration-75 rounded-lg group hover:bg-[#009348] {{ request()->is('pengurus/kas-harian*') || request()->is('pengurus/jkm*') || request()->is('pengurus/jkk*') || request()->is('pengurus/rekap-jkm*') || request()->is('pengurus/rekap-jkk*') ? 'bg-[#009348]' : '' }}"
              aria-controls="dropdown-ecommerce" data-collapse-toggle="dropdown-ecommerce">
              <i data-lucide="banknote" class="text-white mr-3 group-hover:text-white"></i>
              <span class="flex-1 text-left whitespace-nowrap font-medium group-hover:text-white">Kas</span>
              <svg class="w-3 h-3 text-white group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4" />
              </svg>
          </button>
          <ul id="dropdown-ecommerce" class="space-y-1 {{ request()->is('pengurus/kas-harian*') || request()->is('pengurus/jkm*') || request()->is('pengurus/jkk*') || request()->is('pengurus/rekap-jkm*') || request()->is('pengurus/rekap-jkk*') ? '' : 'hidden' }}">
              <li>
                  <a href="{{ route('pengurus.kas-harian.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/kas-harian*') ? 'bg-[#009348]' : '' }}">Kas Harian</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.jkm')}}" class="flex items-center w full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/jkm*') ? 'bg-[#009348]' : '' }}">Jurnal Kas Masuk</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.jkk')}}" class="flex items-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/jkk*') ? 'bg-[#009348]' : '' }}">Jurnal Kas Keluar</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.rekap-jkm')}}" class="flex items-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/rekap-jkm*') ? 'bg-[#009348]' : '' }}">Rekap JKM</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.rekap-jkk')}}" class="flex items-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/rekap-jkk*') ? 'bg-[#009348]' : '' }}">Rekap JKK</a>
              </li>
          </ul>
      </li>
      <li>
        <a href="{{ route('pengurus.simpanan.index') }}"
            class="flex items-center p-2 text-white rounded-lg hover:bg-[#009348] group {{ Request::is('pengurus/simpanan*') ? 'bg-[#009348]' : '' }}">
            <i data-lucide="landmark" class="text-white mr-3 group-hover:text-white"></i>
            <span class="font-medium group-hover:text-white">Simpanan</span>
        </a>
      </li>
      <li>
        <button type="button"
            class="flex items-center w-full p-2 text-white mb-1 transition duration-75 rounded-lg group hover:bg-[#009348] {{ request()->is('pengurus/pengajuan-pinjaman*') || request()->is('pengurus/pinjaman*') || request()->is('pengurus/angsuran*') && !Request::is('pengurus/angsuran-unit-konsumsi*') ? 'bg-[#009348]' : '' }}"
            aria-controls="dropdown-piutang" data-collapse-toggle="dropdown-piutang">
            <i data-lucide="hand-coins" class="text-white mr-3 group-hover:text-white"></i>
            <span class="flex-1 text-left whitespace-nowrap font-medium group-hover:text-white">Piutang</span>
            <svg class="w-3 h-3 text-white group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <ul id="dropdown-piutang" class="space-y-1 {{ request()->is('pengurus/pengajuan-pinjaman*') || request()->is('pengurus/pinjaman*') || request()->is('pengurus/angsuran*') && !Request::is('pengurus/angsuran-unit-konsumsi*') ? '' : 'hidden' }}">
            <li>
                <a href="{{ route('pengurus.pengajuan-pinjaman.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/pengajuan-pinjaman*') ? 'bg-[#009348]' : '' }}">Pengajuan Pinjaman</a>
            </li>
            <li>
                <a href="{{ route('pengurus.pinjaman.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/pinjaman*') ? 'bg-[#009348]' : '' }}">Pinjaman</a>
            </li>
            <li>
                <a href="{{ route('pengurus.angsuran.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/angsuran*') && !Request::is('pengurus/angsuran-unit-konsumsi*') ? 'bg-[#009348]' : '' }}">Angsuran</a>
            </li>
        </ul>
      </li>
      <li>
        <button type="button"
            class="flex items-center w-full p-2 text-white mb-1 transition duration-75 rounded-lg group hover:bg-[#009348] {{ request()->is('pengurus/pengajuan-unit-konsumsi*') || request()->is('pengurus/unit-konsumsi*') || request()->is('pengurus/angsuran-unit-konsumsi*') ? 'bg-[#009348]' : '' }}"
            aria-controls="dropdown-unit-konsumsi" data-collapse-toggle="dropdown-unit-konsumsi">
            <i data-lucide="utensils" class="text-white mr-3 group-hover:text-white"></i>
            <span class="flex-1 text-left whitespace-nowrap font-medium group-hover:text-white">Unit Konsumsi</span>
            <svg class="w-3 h-3 text-white group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <ul id="dropdown-unit-konsumsi" class="space-y-1 {{ request()->is('pengurus/pengajuan-unit-konsumsi*') || request()->is('pengurus/unit-konsumsi*') || request()->is('pengurus/angsuran-unit-konsumsi*') ? '' : 'hidden' }}">
            <li>
                <a href="{{ route('pengurus.pengajuan-unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/pengajuan-unit-konsumsi*') ? 'bg-[#009348]' : '' }}">Pengajuan Unit Konsumsi</a>
            </li>
            <li>
                <a href="{{ route('pengurus.unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/unit-konsumsi*') ? 'bg-[#009348]' : '' }}">Unit Konsumsi</a>
            </li>
            <li>
                <a href="{{ route('pengurus.angsuran-unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-white transition duration-75 rounded-lg pl-11 group hover:bg-[#009348] hover:text-white text-sm {{ Request::is('pengurus/angsuran-unit-konsumsi*') ? 'bg-[#009348]' : '' }}">Angsuran</a>
            </li>
        </ul>
      </li>
      <li>
          <a href="{{ route('pengurus.riwayat-transaksi.index') }}"
              class="flex items-center p-2 text-white rounded-lg hover:bg-[#009348] group {{ Request::is('pengurus/riwayat-transaksi*') ? 'bg-[#009348]' : '' }}">
              <i data-lucide="history" class="text-white mr-3 group-hover:text-white"></i>
              <span class="font-medium group-hover:text-white">Riwayat Transaksi</span>
          </a>
      </li>
    </li>
  </ul>


    <script>
      function toggleDropdown(dropdownId, headerId) {
        const dropdown = document.getElementById(dropdownId);
        const header = document.getElementById(headerId);

        const isOpen = !dropdown.classList.contains("hidden");

        // Tutup semua dropdown sebelum membuka yang baru
        document.querySelectorAll(".group > div:nth-child(2)").forEach((el) => el.classList.add("hidden"));
        document.querySelectorAll(".group > div:nth-child(1)").forEach((el) => el.classList.remove("bg-green-700"));

        if (!isOpen) {
          dropdown.classList.remove("hidden");
          header.classList.add("bg-green-700");
        } else {
          dropdown.classList.add("hidden");
          header.classList.remove("bg-green-700");
        }
      }
    </script>

    <script>
      document.getElementById("userDropdownToggle").addEventListener("click", function (e) {
        e.preventDefault();
        const dropdown = document.getElementById("userDropdownMenu");
        dropdown.classList.toggle("hidden");
      });

      // Close dropdown when clicking outside
      document.addEventListener("click", function (e) {
        const dropdown = document.getElementById("userDropdownMenu");
        const toggleButton = document.getElementById("userDropdownToggle");

        if (!dropdown.contains(e.target) && !toggleButton.contains(e.target)) {
          dropdown.classList.add("hidden");
        }
      });
    </script>
</div>

