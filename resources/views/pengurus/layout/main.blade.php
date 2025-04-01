<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  {{-- <title>KPRI Grafika - </title> --}}
  <title>KPRI Grafika - @yield('title', 'KPRI Grafika')</title>
  <link rel="icon" type="image/png" href="{{ asset('storage/assets/logo_kpri.png') }}">
  @vite('resources/css/app.css');
  @vite('resources/js/app.js')

  @livewireStyles
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
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
      z-index: 1000;
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

    @media (max-width: 768px) {
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
    @media (min-width: 768px) {
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

  @include('pengurus.layout.sidebar')

  <div class="">

    @include('pengurus.layout.header')
    
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

      if (window.innerWidth <= 768) {
        // Mobile behavior
        sidebar.classList.toggle("active");
        mainContent.classList.toggle("shifted");
      } else {
        // Desktop behavior
        sidebar.classList.toggle("collapsed");
        mainContent.classList.toggle("expanded");
      }
    }

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/js/tom-select.complete.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  @livewireScripts
  @stack('scripts')
</body>
</html>