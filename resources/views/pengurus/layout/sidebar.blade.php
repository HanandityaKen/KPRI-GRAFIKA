<div class="w-56 bg-[#DCFED0] h-screen p-4 fixed-sidebar text-sm">
  <!-- Logo and Brand -->
  <div class="flex items-center mb-10">
    <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-[50px] mr-3" alt="Logo" />
    <h2 class="font-bold text-green-800">KPRI Grafika</h2>
    <div class="flex flex-1 justify-end">
      <i data-lucide="menu" class="text-green-800 group-hover:text-white cursor-pointer toggle2sidebar" onclick="toggleSidebar()"></i>
    </div>
  </div>

  
  <ul class="space-y-1 font-medium">
      <li>
          <a href="{{ route('pengurus.dashboard') }}"
              class="flex items-center p-2 text-green-800 rounded-lg hover:bg-green-700 group">
              <i data-lucide="layout-dashboard" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="font-semibold group-hover:text-white">Dashboard</span>
          </a>
      </li>
      <li>
          <button type="button"
              class="flex items-center w-full p-2 text-green-800 transition duration-75 rounded-lg group hover:bg-green-700"
              aria-controls="dropdown-kas-harian" data-collapse-toggle="dropdown-kas-harian">
              <i data-lucide="banknote" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="flex-1 text-left whitespace-nowrap font-semibold group-hover:text-white">Kas</span>
              <svg class="w-3 h-3 text-green-800 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4" />
              </svg>
          </button>
          <ul id="dropdown-kas-harian" class="hidden space-y-0">
              <li>
                  <a href="{{ route('pengurus.kas-harian.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Kas Harian</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.jkm') }}" class="flex items-center w full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Jurnal Kas Masuk</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.jkk') }}" class="flex items-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Jurnal Kas Keluar</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.rekap-jkm') }}" class="flex items-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Rekap JKM</a>
              </li>
              <li>
                  <a href="{{ route('pengurus.rekap-jkk') }}" class="flex items-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Rekap JKK</a>
              </li>
          </ul>
      </li>
      <li>
        <a href="{{ route('pengurus.simpanan.index') }}"
            class="flex items-center p-2 text-green-800 rounded-lg hover:bg-green-700 group">
            <i data-lucide="landmark" class="text-green-800 mr-3 group-hover:text-white"></i>
            <span class="font-semibold group-hover:text-white">Simpanan</span>
        </a>
      </li>
      <li>
        <button type="button"
            class="flex items-center w-full p-2 text-green-800 transition duration-75 rounded-lg group hover:bg-green-700"
            aria-controls="dropdown-piutang" data-collapse-toggle="dropdown-piutang">
            <i data-lucide="hand-coins" class="text-green-800 mr-3 group-hover:text-white"></i>
            <span class="flex-1 text-left whitespace-nowrap font-semibold group-hover:text-white">Piutang</span>
            <svg class="w-3 h-3 text-green-800 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <ul id="dropdown-piutang" class="hidden space-y-0">
            <li>
                <a href="{{ route('pengurus.pengajuan-pinjaman.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pengajuan Pinjaman</a>
            </li>
            <li>
                <a href="{{ route('pengurus.pinjaman.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pinjaman</a>
            </li>
            <li>
                <a href="{{ route('pengurus.angsuran.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Angsuran</a>
            </li>
        </ul>
      </li>
      <li>
        <button type="button"
            class="flex items-center w-full p-2 text-green-800 transition duration-75 rounded-lg group hover:bg-green-700"
            aria-controls="dropdown-unit-konsumsi" data-collapse-toggle="dropdown-unit-konsumsi">
            <i data-lucide="utensils" class="text-green-800 mr-3 group-hover:text-white"></i>
            <span class="flex-1 text-left whitespace-nowrap font-semibold group-hover:text-white">Unit Konsumsi</span>
            <svg class="w-3 h-3 text-green-800 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <ul id="dropdown-unit-konsumsi" class="hidden space-y-0">
            <li>
                <a href="{{ route('pengurus.pengajuan-unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pengajuan Unit Konsumsi</a>
            </li>
            <li>
                <a href="{{ route('pengurus.unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Unit Konsumsi</a>
            </li>
            <li>
                <a href="{{ route('pengurus.angsuran-unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Angsuran</a>
            </li>
        </ul>
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

      function toggleSidebar() {
        const sidebar = document.querySelector(".fixed-sidebar");
        sidebar.classList.toggle("active");
      }

      function toggleSidebar() {
        const sidebar = document.querySelector(".fixed-sidebar");
        const mainContent = document.querySelector(".main-content");

        if (window.innerWidth <= 768) {
          // Mobile behavior
          sidebar.classList.add("active");
          mainContent.classList.add("shifted");
        } else {
          // Desktop behavior
          sidebar.classList.add("collapsed");
          mainContent.classList.add("expanded");
        }
      }

      // Add window resize listener to handle responsive behavior
      window.addEventListener("resize", function () {
        const sidebar = document.querySelector(".fixed-sidebar");
        const mainContent = document.querySelector(".main-content");

        if (window.innerWidth <= 768) {
          sidebar.classList.remove("collapsed");
          mainContent.classList.remove("expanded");
          sidebar.classList.remove("active");
          mainContent.classList.remove("shifted");
        } else {
          sidebar.classList.remove("active");
          mainContent.classList.remove("shifted");
        }
      });
    </script>
</div>
