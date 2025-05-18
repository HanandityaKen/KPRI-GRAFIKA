<nav class="bg-white shadow-md p-4 lg:px-16 lg:py-3 flex items-center justify-between relative">
  <div class="flex items-center space-x-0 z-10">
        <button id="menuToggle" class="xl:hidden block text-green-800 focus:outline-none">
          <i data-lucide="menu"></i>
        </button>
    <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-12 mr-2" alt="Logo" />
    <span class="font-bold text-lg text-green-800">KPRI Grafika</span>
  </div>
  
  <!-- Tengah: Menu (hanya tampil di desktop dan tetap bisa di-toggle di mobile) -->
  <div class="hidden xl:flex flex-1 justify-center pl-20">
    <ul id="menuMobile" class="flex space-x-6 items-center">
      <li><a href="{{ route('dashboard') }}" class="text-base font-semibold {{ Request::is('dashboard') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Beranda</a></li>
      <li><a href="{{ route('simpanan') }}" class="text-base font-semibold {{ Request::is('simpanan') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Simpanan</a></li>
      <li><a href="{{ route('pinjaman') }}" class="text-base font-semibold {{ Request::is('pinjaman') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Pinjaman</a></li>
      <li><a href="{{ route('unit-konsumsi') }}" class="text-base font-semibold {{ Request::is('unit-konsumsi') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Unit Konsumsi</a></li>
      <li><a href="{{ route('riwayat') }}" class="text-base font-semibold {{ Request::is('riwayat') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Riwayat</a></li>
    </ul>
  </div>

    <!--Tampilan Mobile-->
  <ul id="menu" class="xl:hidden hidden flex-col bg-white shadow-md absolute top-full left-4 right-4 rounded-lg px-4 md:px-12 py-3 z-40 transition-all duration-300 ease-in-out space-y-2">
    <li><a href="{{ route('dashboard') }}" class="text-sm font-semibold {{ Request::is('dashboard') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Beranda</a></li>
    <li><a href="{{ route('simpanan') }}" class="text-sm font-semibold {{ Request::is('simpanan') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Simpanan</a></li>
    <li><a href="{{ route('pinjaman') }}" class="text-sm font-semibold {{ Request::is('pinjaman') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Pinjaman</a></li>
    <li><a href="{{ route('unit-konsumsi') }}" class="text-sm font-semibold {{ Request::is('unit-konsumsi') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Unit Konsumsi</a></li>
    <li><a href="{{ route('riwayat') }}" class="text-sm font-semibold {{ Request::is('riwayat') ? 'text-green-800' : 'text-gray-600 hover:text-green-800' }}">Riwayat</a></li>
  </ul>

  <!-- Avatar -->
  <div class="relative z-10">
    <button type="button" id="userDropdownToggle" class="flex gap-2 sm:gap-4 items-center text-sm cursor-pointer">
      <!-- Avatar Image -->
      <img src="{{ Auth::guard('anggota')->user()->foto_profile ? asset('storage/' . Auth::guard('anggota')->user()->foto_profile) : asset('storage/assets/default-avatar.webp') }}" class="rounded-full w-9 h-9 sm:w-10 sm:h-10" alt="Avatar" />
      <!-- User Info -->
        <div class="hidden sm:block">
          <h4 class="text-green-800 text-left font-semibold text-base">{{ Auth::guard('anggota')->user()->nama }}</h4>
          <h4 class="text-sm text-left text-gray-500">{{ ucwords(Auth::guard('anggota')->user()->posisi) }}</h4>
        </div>
        <!-- Dropdown Icon -->
        <i data-lucide="chevron-down" class="text-green-800 sm:mr-1"></i>
    </button>

    <!-- Dropdown Menu -->
    <div id="userDropdownMenu" class="hidden absolute right-0 mt-3 w-48 bg-white border rounded-lg shadow-lg z-50">
      <ul class="py-0">
        <li>
          <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100 text-xs rounded-t-lg">
            Profile
          </a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-xs rounded-b-lg">
              Logout
            </button>
          </form>
        </li>
      </ul>      
    </div>
  </div>
</nav>