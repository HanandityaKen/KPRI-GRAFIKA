<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $namaKoperasi->nama }} - @yield('title', 'KPRI Grafika')</title>
  <link rel="icon" type="image/png" href="{{ asset('storage/logo-koperasi/' . $logoKoperasi->logo ) }}">
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
  <link rel="stylesheet" href="{{ asset('build/assets/app-DKUdofUZ.css') }}">
  <script src="{{ asset('build/assets/app-DA3rf8Wk.js') }}" defer></script>
  @livewireStyles
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/css/tom-select.css" rel="stylesheet">
  <style>
    /* Transition for smooth sliding */
    .fixed-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      overflow-y: auto;
      width: 16rem;
      transition: transform 0.3s ease-in-out;
    }

    .main-content {
      transition: margin-left 0.3s ease-in-out;
      width: calc(100% - 16rem);
      margin-left: 16rem;
    }

    /* Collapsed state */
    .fixed-sidebar.collapsed {
      transform: translateX(-100%);
    }

    .main-content.expanded {
      margin-left: 0;
      width: 100%;
    }

    @media (max-width: 1023px) {
      .fixed-sidebar {
        transform: translateX(-100%);
      }

      .fixed-sidebar.active {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0;
        width: 100%;
      }
      .toggle2sidebar {
        display: block;
      }
    }
    @media (min-width: 1023px) {
      .toggle2sidebar {
        display: none;
      }
    }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
  </style>
</head>
<body>

  {{-- Sidebar --}}
  @include('admin.layout.sidebar')

  {{-- Main Content --}}
  <div class="">

    {{-- Header --}}
    @include('admin.layout.header')
    
    <main id="mainContent" class="flex-1 p-6 pt-16 lg:ml-64 transition-all duration-300">
      @yield('content')
    </main>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector(".fixed-sidebar");
      sidebar.classList.toggle("active");
    }

    function toggleSidebar() {
      const sidebar = document.querySelector(".fixed-sidebar");
      const mainContent = document.querySelector(".main-content");

      if (window.innerWidth < 1025) {
        // Mobile behavior
        sidebar.classList.toggle("active");
        mainContent.classList.toggle("shifted");
      } else {
        // Desktop behavior
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("expanded");
      }
    }

    // Add window resize listener to handle responsive behavior
    window.addEventListener("resize", function () {
      const sidebar = document.querySelector(".fixed-sidebar");
      const mainContent = document.querySelector(".main-content");

      if (window.innerWidth < 1025) {
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/js/tom-select.complete.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
  @livewireScripts
  @stack('scripts')
</body>
</html>