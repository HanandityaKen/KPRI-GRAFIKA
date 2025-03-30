<nav class="bg-white shadow-md p-4 flex justify-between items-center">
  <div class="flex items-center space-x-2">
    <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-[50px] mr-3" alt="Logo" />
    <h2 class="font-bold text-green-800">KPRI Grafika</h2>
  </div>

  <ul class="hidden md:flex space-x-6">
    <li><a href="beranda.html" class="text-green-600 font-semibold text-sm">Beranda</a></li>
    <li><a href="simpanan-user.html" class="text-gray-600 text-sm hover:text-green-600">Simpanan</a></li>
    <li><a href="pinjaman-user.html" class="text-gray-600 text-sm hover:text-green-600">Pinjaman</a></li>
    <li><a href="profile-user.html" class="text-gray-600 text-sm hover:text-green-600">Profile</a></li>
  </ul>

  <!-- Avatar dan Dropdown Toggle -->
  <div class="relative">
  <a href="#" id="userDropdownToggle" class="flex gap-2 sm:gap-4 items-center text-sm cursor-pointer">
    <!-- Avatar Image -->
    <img src="{{ Auth::guard('anggota')->user()->foto_profile ? asset('storage/' . Auth::guard('anggota')->user()->foto_profile) : asset('storage/assets/default-avatar.webp') }}" class="rounded-full w-8 h-8 sm:w-10 sm:h-10" alt="Avatar" />
    <!-- User Info -->
    <div class="flex items-center gap-1 sm:gap-2">
      <div class="hidden sm:block">
        <h4 class="text-green-800 font-semibold">{{ Auth::guard('anggota')->user()->nama }}</h4>
        <h4 class="text-xs text-gray-500">{{ ucwords(Auth::guard('anggota')->user()->posisi) }}</h4>
      </div>
      <!-- Dropdown Icon -->
      <i data-lucide="chevron-down" class="text-green-800 sm:mr-3"></i>
    </div>
  </a>

  <!-- Dropdown Menu -->
  <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-50">
    <ul class="py-1">
      <li>
        <a href="profile.html" class="block px-4 py-2 hover:bg-gray-100 text-xs">Profile</a>
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