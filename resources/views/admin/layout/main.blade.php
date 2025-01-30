<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KPRI Grafika - </title>
  <link rel="icon" type="image/png" href="{{ asset('storage/assets/logo_kpri.png') }}">
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
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
  </style>
</head>
<body>

  {{-- Sidebar --}}
  @include('admin.layout.sidebar')

  {{-- Main Content --}}
  <div class="flex-1 overflow-y-auto">

    {{-- Header --}}
    @include('admin.layout.header')
    
    <main id="mainContent" class="flex-1 p-6 pt-20 lg:ml-64 transition-all duration-300">
      @yield('content')
    </main>
  </div>

  {{-- <script src="../assets/js/toggle-sidebar.js"></script>
  <script src="../assets/js/dropdown.js"></script> --}}
  <script>
    lucide.createIcons();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

  @stack('scripts')

</body>
</html>