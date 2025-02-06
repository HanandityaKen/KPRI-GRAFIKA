<div class="w-56 bg-[#DCFED0] h-screen p-4 fixed-sidebar text-sm">
  <!-- Logo and Brand -->
  <div class="flex items-center mb-10">
    <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-[50px] mr-3" alt="Logo" />
    <h2 class="font-bold text-green-800">KPRI Grafika</h2>
    <div class="flex flex-1 justify-end">
      <i data-lucide="menu" class="text-green-800 group-hover:text-white cursor-pointer toggle2sidebar" onclick="toggleSidebar()"></i>
    </div>
  </div>

  <!-- Navigation Links -->
  <nav class="space-y-1 ">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/dashboard') ? 'opacity-100' : 'opacity-60' }}">
      <i data-lucide="layout-dashboard" class="  text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Dashboard</span>
    </a>
    <a href="{{ route('admin.anggota.index' )}}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/anggota*') ? 'opacity-100' : 'opacity-60' }}">
      <i data-lucide="users" class="text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Anggota</span>
    </a>
    <a href="{{ route('admin.pengurus.index') }}" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group text-sm {{ Request::is('admin/pengurus*') ? 'opacity-100' : 'opacity-60' }}">
      <i data-lucide="user-cog" class="text-green-800 mr-3 group-hover:text-white"></i>
      <span class="text-green-800 font-semibold group-hover:text-white">Pengurus</span>
    </a>
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
  </nav>
</div>
