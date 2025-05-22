<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaKoperasi->nama }} - @yield('title', 'KPRI Grafika')</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo-koperasi/' . $logoKoperasi->logo) }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-BGES5BSS.css') }}">
    <script src="{{ asset('build/assets/app-DA3rf8Wk.js') }}" defer></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar -->
    @include('anggota.layout.header')

    @yield('content')

    <!-- Footer -->
    @include('anggota.layout.footer')

    <script>
      document.getElementById('menuToggle').addEventListener('click', function () {
        document.getElementById('menu').classList.toggle('hidden');
      });
    
      document.getElementById('userDropdownToggle').addEventListener('click', function () {
        document.getElementById('userDropdownMenu').classList.toggle('hidden');
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @stack('scripts')
  </body>
</html>