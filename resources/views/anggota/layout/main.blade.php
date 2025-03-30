<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KPRI Grafika - @yield('title', 'KPRI Grafika')</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/assets/logo_kpri.png') }}">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar -->
    @include('anggota.layout.header')

    @yield('content')

    <!-- Footer -->
    @include('anggota.layout.footer')

    <script>
      lucide.createIcons();
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const userDropdownToggle = document.getElementById("userDropdownToggle");
        const userDropdownMenu = document.getElementById("userDropdownMenu");
    
        userDropdownToggle.addEventListener("click", function (event) {
          event.preventDefault(); // Mencegah default link
          userDropdownMenu.classList.toggle("hidden"); // Toggle hidden class
        });
    
        // Klik di luar dropdown untuk menutupnya
        document.addEventListener("click", function (event) {
          if (!userDropdownToggle.contains(event.target) && !userDropdownMenu.contains(event.target)) {
            userDropdownMenu.classList.add("hidden");
          }
        });
      });
    </script>    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    @stack('scripts')
  </body>
</html>