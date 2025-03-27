<div class="w-56 bg-[#DCFED0] h-screen p-4 fixed-sidebar text-sm no-scrollbar">
  <!-- Logo and Brand -->
  <div class="flex items-center mb-10">
    <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-[50px] mr-3" alt="Logo" />
    <h2 class="font-bold text-green-800">KPRI Grafika</h2>
    <div class="flex flex-1 justify-end">
      <i data-lucide="menu" class="text-green-800 group-hover:text-white cursor-pointer toggle2sidebar" onclick="toggleSidebar()"></i>
    </div>
  </div>

  <!-- Navigation Links -->
  {{-- <nav class="space-y-1 ">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/dashboard') ? 'opacity-100' : 'opacity-100' }}">
      <i data-lucide="layout-dashboard" class="  text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Dashboard</span>
    </a>
    <a href="{{ route('admin.anggota.index' )}}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/anggota*') ? 'opacity-100' : 'opacity-100' }}">
      <i data-lucide="users" class="text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Anggota</span>
    </a>
    <a href="{{ route('admin.pengurus.index') }}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/pengurus*') ? 'opacity-100' : 'opacity-100' }}">
      <i data-lucide="user-cog" class="text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Pengurus</span>
    </a>
    <a href="{{ route('admin.kas-harian.index') }}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/kas-harian*') ? 'opacity-100' : 'opacity-60' }}">
      <i data-lucide="banknote" class="text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Kas Harian</span>
    </a>
    <!-- Kas Dropdown -->
    <div class="group">
      <div id="kasHeader" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer" onclick="toggleDropdown('kasDropdown', 'kasHeader')">
        <i data-lucide="banknote" class="text-green-800 mr-2 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white flex-1">Kas</span>
        <i data-lucide="chevron-down" class="text-green-800"></i>
      </div>
      <div id="kasDropdown" class="hidden pl-6 space-y-2">
        <a href="{{ route('admin.kas-harian.index') }}" class="block text-green-800 hover:text-green-950">Kas Harian</a>
        <a href="jurnal-kas-masuk.html" class="block text-green-800 hover:text-green-950">Jurnal Kas Masuk</a>
        <a href="jurnal-kas-keluar.html" class="block text-green-800 hover:text-green-950">Jurnal Kas Keluar</a>
        <a href="rekap-jkm.html" class="block text-green-800 hover:text-green-950">Rekap JKM</a>
        <a href="rekap-jkk.html" class="block text-green-800 hover:text-green-950">Rekap JKK</a>
      </div>
    </div>
  </nav> --}}

  <ul class="space-y-1 font-medium">
      <li>
          <a href="{{ route('admin.dashboard') }}"
              class="flex items-center p-2 text-green-800 rounded-lg hover:bg-green-700 group">
              <i data-lucide="layout-dashboard" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="font-semibold group-hover:text-white">Dashboard</span>
          </a>
      </li>
      <li>
          <a href="{{ route('admin.anggota.index') }}"
              class="flex items-center p-2 text-green-800 rounded-lg hover:bg-green-700 group">
              <i data-lucide="users" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="font-semibold group-hover:text-white">Anggota</span>
          </a>
      </li>
      <li>
          <a href="{{ route('admin.pengurus.index') }}"
              class="flex items-center p-2 text-green-800 rounded-lg hover:bg-green-700 group">
              <i data-lucide="id-card" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="font-semibold group-hover:text-white">Pengurus</span>
          </a>
      </li>
      <li>
          <button type="button"
              class="flex items-center w-full p-2 text-green-800 transition duration-75 rounded-lg group hover:bg-green-700"
              aria-controls="dropdown-ecommerce" data-collapse-toggle="dropdown-ecommerce">
              <i data-lucide="banknote" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="flex-1 text-left whitespace-nowrap font-semibold group-hover:text-white">Kas</span>
              <svg class="w-3 h-3 text-green-800 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4" />
              </svg>
          </button>
          <ul id="dropdown-ecommerce" class="hidden space-y-0">
              <li>
                  <a href="{{ route('admin.kas-harian.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Kas Harian</a>
              </li>
              <li>
                  <a href="{{ route('admin.jkm')}}" class="flex items-center w full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Jurnal Kas Masuk</a>
              </li>
              <li>
                  <a href="{{ route('admin.jkk')}}" class="flex items-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Jurnal Kas Keluar</a>
              </li>
              <li>
                  <a href="{{ route('admin.rekap-jkm')}}" class="flex items-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Rekap JKM</a>
              </li>
              <li>
                  <a href="{{ route('admin.rekap-jkk')}}" class="flex items-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Rekap JKK</a>
              </li>
          </ul>
      </li>
      <li>
        <a href="{{ route('admin.simpanan.index') }}"
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
                <a href="{{ route('admin.pengajuan-pinjaman.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pengajuan Pinjaman</a>
            </li>
            <li>
                <a href="{{ route('admin.pinjaman.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pinjaman</a>
            </li>
            <li>
                <a href="{{ route('admin.angsuran.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Angsuran</a>
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
                <a href="{{ route('admin.pengajuan-unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pengajuan Unit Konsumsi</a>
            </li>
            <li>
                <a href="{{ route('admin.unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Unit Konsumsi</a>
            </li>
            <li>
                <a href="{{ route('admin.angsuran-unit-konsumsi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Angsuran</a>
            </li>
        </ul>
      </li>
      <li>
          <a href="{{ route('admin.riwayat-transaksi.index') }}"
              class="flex items-center p-2 text-green-800 rounded-lg hover:bg-green-700 group">
              <i data-lucide="history" class="text-green-800 mr-3 group-hover:text-white"></i>
              <span class="font-semibold group-hover:text-white">Riwayat Transaksi</span>
          </a>
      </li>
      <li>
        <button type="button"
            class="flex items-center w-full p-2 text-green-800 transition duration-75 rounded-lg group hover:bg-green-700"
            aria-controls="dropdown-master-settings" data-collapse-toggle="dropdown-master-settings">
            <i data-lucide="settings" class="text-green-800 mr-3 group-hover:text-white"></i>
            <span class="flex-1 text-left whitespace-nowrap font-semibold group-hover:text-white">Master Settings</span>
            <svg class="w-3 h-3 text-green-800 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <ul id="dropdown-master-settings" class="hidden space-y-0">
            <li>
                <a href="{{ route('admin.persentase.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Persentase</a>
            </li>
            <li>
                <a href="{{ route('admin.saldo-koperasi.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Saldo Koperasi</a>
            </li>
            <li>
                <a href="{{ route('admin.pokok.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Pokok</a>
            </li>
            <li>
                <a href="{{ route('admin.wajib.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Wajib</a>
            </li>
            <li>
                <a href="{{ route('admin.wajib-pinjam.index') }}" class="flex item-center w-full p-1 text-green-800 transition duration-75 rounded-lg pl-11 group hover:bg-green-700 hover:text-white text-sm">Wajib Pinjam</a>
            </li>
        </ul>
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
    
    {{-- <div>
      <a href="simpanan.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/simpanan') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="wallet" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Simpanan</span>
      </a>
      <a href="keuangan.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/keuangan') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="credit-card" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Keuangan</span>
      </a>
      <a href="pembagian-shu.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/pembagian-shu') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="pie-chart" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Pembagian SHU</span>
      </a>
      <a href="sisa-hutang-anggota.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/sisa-hutang-anggota') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="file-text" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Sisa Hutang Anggota</span>
      </a>
      <a href="angsuran.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/angsuran') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="hand-coins" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Angsuran</span>
      </a>
      <a href="pinjaman.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/pinjaman') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="calculator" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Pinjaman</span>
      </a>
      <a href="presentase.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/persentase') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="chart-no-axes-column" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Persentase</span>
      </a>
      <a href="manasuka.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/manasuka') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="grid-3x3" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Manasuka</span>
      </a>
      <a href="unit-konsumsi.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/unit-konsumsi') ? 'opacity-100' : 'opacity-60' }}">
        <i data-lucide="utensils" class="text-green-800 mr-3 group-hover:text-white"></i>
        <span class="text-green-800 font-semibold group-hover:text-white">Unit Konsumsi</span>
      </a>
    </div> --}}
</div>
