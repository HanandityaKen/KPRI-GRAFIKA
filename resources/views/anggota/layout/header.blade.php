<nav class="bg-white shadow-md p-4 flex items-center justify-between relative">
  <div class="flex items-center space-x-0 z-10">
        <button id="menuToggle" class="md:hidden block text-green-800 focus:outline-none">
          <i data-lucide="menu"></i>
        </button>
    <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-[50px] mr-2" alt="Logo" />
    <h2 class="font-bold text-green-800">KPRI Grafika</h2>
  </div>
  
  <!-- Tengah: Menu (hanya tampil di desktop dan tetap bisa di-toggle di mobile) -->
  <div class="hidden md:flex flex-1 justify-center pl-12">
    <ul id="menuMobile" class="flex space-x-6 items-center">
      <li><a href="{{ route('dashboard') }}" class="text-sm font-semibold {{ Request::is('dashboard') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Beranda</a></li>
      <li><a href="{{ route('simpanan') }}" class="text-sm font-semibold {{ Request::is('simpanan') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Simpanan</a></li>
      <li><a href="{{ route('pinjaman') }}" class="text-sm font-semibold {{ Request::is('pinjaman') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Pinjaman</a></li>
      <li><a href="{{ route('unit-konsumsi') }}" class="text-sm font-semibold {{ Request::is('unit-konsumsi') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Unit Konsumsi</a></li>
      <li><a href="{{ route('riwayat') }}" class="text-sm font-semibold {{ Request::is('riwayat') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Riwayat</a></li>
    </ul>
  </div>

    <!--Tampilan Mobile-->
  <ul id="menu" class="md:hidden hidden flex-col bg-white shadow-md absolute top-full left-4 right-4 rounded-lg p-4 z-40 transition-all duration-300 ease-in-out">
    <li><a href="{{ route('dashboard') }}" class="text-sm font-semibold {{ Request::is('dashboard') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Beranda</a></li>
    <li><a href="{{ route('simpanan') }}" class="text-sm font-semibold {{ Request::is('simpanan') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Simpanan</a></li>
    <li><a href="{{ route('pinjaman') }}" class="text-sm font-semibold {{ Request::is('pinjaman') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Pinjaman</a></li>
    <li><a href="{{ route('unit-konsumsi') }}" class="text-sm font-semibold {{ Request::is('unit-konsumsi') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Unit Konsumsi</a></li>
    <li><a href="{{ route('riwayat') }}" class="text-sm font-semibold {{ Request::is('riwayat') ? 'text-green-600' : 'text-gray-600 hover:text-green-600' }}">Riwayat</a></li>
  </ul>

  <!-- Avatar -->
  <div class="relative z-10">
    <button type="button" id="userDropdownToggle" class="flex gap-2 sm:gap-4 items-center text-sm cursor-pointer">
      <!-- Avatar Image -->
      <img src="{{ Auth::guard('anggota')->user()->foto_profile ? asset('storage/' . Auth::guard('anggota')->user()->foto_profile) : asset('storage/assets/default-avatar.webp') }}" class="rounded-full w-8 h-8 sm:w-10 sm:h-10" alt="Avatar" />
      <!-- User Info -->
        <div class="hidden sm:block">
          <h4 class="text-green-800 text-left font-semibold">{{ Auth::guard('anggota')->user()->nama }}</h4>
          <h4 class="text-xs text-left text-gray-500">{{ ucwords(Auth::guard('anggota')->user()->posisi) }}</h4>
        </div>
        <!-- Dropdown Icon -->
        <i data-lucide="chevron-down" class="text-green-800 sm:mr-1"></i>
    </button>

    <!-- Dropdown Menu -->
    <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50">
      <ul class="py-1">
        <li>
          <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100 text-xs">Profile</a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
              @csrf
              <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-xs">
                  Logout
              </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>