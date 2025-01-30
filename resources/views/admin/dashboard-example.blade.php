<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KPRI Grafika - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/assets/logo_kpri.png') }}">
    @vite('resources/css/app.css')
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
  <body class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-[#DCFED0] h-screen p-4 fixed-sidebar">
      <!-- Logo and Brand -->
      <div class="flex items-center mb-10">
        <img src={{ asset('storage/assets/logo_kpri.png') }} class="w-[50px] mr-3" alt="Logo" />
        <h2 class="font-bold text-green-800">KPRI Grafika</h2>
        <div class="flex flex-1 justify-end">
          <i data-lucide="square-x" class="text-green-800 group-hover:text-white cursor-pointer toggle2sidebar" onclick="toggleSidebar()"></i>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="space-y-2">
        <a href="dashboard.html" class="flex items-center p-2 hover:bg-green-700 rounded cursor-pointer group">
          <i data-lucide="layout-dashboard" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Dashboard</span>
        </a>
        <a href="anggota.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="users" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Anggota</span>
        </a>
        <a href="simpanan.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="wallet" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Simpanan</span>
        </a>
        <a href="keuangan.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="credit-card" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Keuangan</span>
        </a>
        <a href="pembagian-shu.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="pie-chart" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Pembagian SHU</span>
        </a>
        <a href="sisa-hutang-anggota.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="file-text" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Sisa Hutang Anggota</span>
        </a>
        <a href="pengurus.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="user-cog" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Pengurus</span>
        </a>
        <a href="angsuran.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="hand-coins" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Angsuran</span>
        </a>
        <a href="pinjaman.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="calculator" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Pinjaman</span>
        </a>
        <a href="presentase.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="chart-no-axes-column" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Presentase</span>
        </a>
        <a href="manasuka.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="grid-3x3" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Manasuka</span>
        </a>
        <a href="unit-konsumsi.html" class="flex items-center p-2 hover:bg-green-700 opacity-70 rounded cursor-pointer group">
          <i data-lucide="utensils" class="text-green-800 mr-3 group-hover:text-white"></i>
          <span class="text-green-800 font-semibold group-hover:text-white">Unit Konsumsi</span>
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 main-content">
      {{-- header --}}
      <header>
        <div class="flex justify-between items-center">
          <!-- Hamburger Menu Button -->
          <button class="mobile-menu-button p-2 focus:outline-none" title="Toggle Sidebar" onclick="toggleSidebar()">
            <i data-lucide="menu" class="text-green-800"></i>
          </button>
  
          <!-- User Avatar with Dropdown -->
          <div class="relative">
            <a href="#" id="userDropdownToggle" class="flex gap-2 sm:gap-4 items-center justify-end">
              <!-- Avatar Image -->
              <img src="../assets/images/avatar.png" class="rounded-full w-8 h-8 sm:w-12 sm:h-12" alt="Avatar" />
              <!-- User Info -->
              <div class="flex items-center gap-1 sm:gap-2">
                <div class="hidden sm:block">
                  <h4 class="text-green-800 font-semibold">John Doe</h4>
                  <h4 class="text-sm text-gray-500">Admin</h4>
                </div>
                <!-- Dropdown Icon -->
                <i data-lucide="chevron-down" class="text-green-800 sm:mr-3 group-hover:text-white"></i>
              </div>
            </a>
  
            <!-- Dropdown Menu -->
            <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-10">
              <ul class="py-1">
                <li>
                  <a href="dashboard-user.html" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                </li>
                <li>
                  <a href="profile.html" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                </li>
                <li>
                  <a href="/index.html" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>

      <main>
        <hr class="my-8 border-t-[2px] border-green-800 opacity-20" />
  
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
  
        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          <div class="bg-gradient-to-br from-[#003705] to-green-700 shadow rounded-lg p-6 flex items-center">
            <i data-lucide="users" class="text-white mr-3"></i>
            <div>
              <p class="text-2xl font-bold text-white">340</p>
              <h3 class="text-white mb-2">Anggota Aktif</h3>
            </div>
          </div>
          <div class="bg-gradient-to-br from-[#2E6A27] to-green-700 shadow rounded-lg p-6 flex items-center">
            <i data-lucide="wallet" class="text-white mr-3"></i>
            <div>
              <p class="text-2xl font-bold text-white">Rp. 350.000.000</p>
              <h3 class="text-white mb-2">Total Simpanan</h3>
            </div>
          </div>
          <div class="bg-gradient-to-br from-[#6DA854] to-green-700 shadow rounded-lg p-6 flex items-center">
            <i data-lucide="credit-card" class="text-white mr-3"></i>
            <div>
              <p class="text-2xl font-bold text-white">Rp. 150.000.000</p>
              <h3 class="text-white mb-2">Total Pinjaman</h3>
            </div>
          </div>
        </div>
  
        <h1 class="text-xl font-bold mb-6">Tabel Anggota</h1>
  
        <!-- Anggota Table -->
        <div class="bg-white shadow rounded-lg border-[2px] border-[#6DA854] overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="p-3 text-left text-[#6DA854]">
                  <div class="flex items-center">No</div>
                </th>
                <th class="p-3 text-left">
                  <div class="flex items-center">
                    Nama
                    <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
                  </div>
                </th>
                <th class="p-3 text-left">
                  <div class="flex items-center">
                    Telepon
                    <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
                  </div>
                </th>
                <th class="p-3 text-left">
                  <div class="flex items-center">
                    Username
                    <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
                  </div>
                </th>
                <th class="p-3 text-left">
                  <div class="flex items-center">
                    Email
                    <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
                  </div>
                </th>
                <th class="p-3 text-left">
                  <div class="flex items-center">
                    Password
                    <i data-lucide="arrow-down-up" class="ml-2 w-4"></i>
                  </div>
                </th>
                <th class="p-3 text-left">
                  <div class="flex items-center">Action</div>
                </th>
              </tr>
            </thead>
            <tbody id="anggotaTableBody">
              <!-- Data akan diisi oleh JavaScript -->
            </tbody>
          </table>
        </div>
      </main>
    </div>

    <script>
      const sampleData = [
        {
          nama: "Sugeng Sumiran, SPd",
          telepon: "08342734234",
          email: "sumiran@gmail.com",
          password: "********",
        },
        {
          nama: "Sri Rahayuningsih, SPd",
          telepon: "08342734234",
          email: "sri@gmailcom",
          password: "********",
        },
        {
          nama: "Dra. Sri Untari, MM",
          telepon: "08342734234",
          email: "untari@gmail.com",
          password: "********",
        },
        {
          nama: "Dra. Umi Lestari",
          telepon: "08342734234",
          email: "lestari@gmail.com",
          password: "********",
        },
        {
          nama: "Edy Sugeng Priyono, SIP",
          telepon: "08342734234",
          email: "sugeng@gmail.com",
          password: "********",
        },
        {
          nama: "Drs. Eko Dewa Sukayanto",
          telepon: "08342734234",
          email: "eko@gmail.com",
          password: "********",
        },
        {
          nama: "Esti Sukorini Rahayu, BA",
          telepon: "08342734234",
          email: "esti@gmail.com",
          password: "********",
        },
        {
          nama: "Dra. Kun Fajarsari",
          telepon: "08342734234",
          email: "kun@gmail.com",
          password: "********",
        },
        {
          nama: "M. Lahmudi, S.Pd",
          telepon: "08342734234",
          email: "lahmudi@gmail.com",
          password: "********",
        },
        {
          nama: "Eko Budi Iswanto, S.Pd",
          telepon: "08342734234",
          email: "budi@gmail.com",
          password: "********",
        },
        {
          nama: "Eru Martyanto, S.Pd",
          telepon: "08342734234",
          email: "eru@gmail.com",
          password: "********",
        },
        {
          nama: "Wageyanto, M.Pd",
          telepon: "08342734234",
          email: "wageyanto@gamil.com",
          password: "********",
        },
        {
          nama: "Rini Soesilowati, S.Pd",
          telepon: "08342734234",
          email: "rini@gmail.com",
          password: "********",
        },
        {
          nama: "Sumarah",
          telepon: "08342734234",
          email: "sumarah@gmail.com",
          password: "********",
        },
        {
          nama: "Titie Swasti, M.Pd",
          telepon: "08342734234",
          email: "titie@gmail.com",
          password: "********",
        },
      ];
      const tableBody = document.getElementById("anggotaTableBody");

      sampleData.forEach((data, index) => {
        const row = document.createElement("tr");
        row.className = "border-b border-[#6DA854]";

        row.innerHTML = `
					<td class="p-3 text-[#6DA854]">${index + 1}</td>
					<td class="p-3">${data.nama}</td>
					<td class="p-3">${data.telepon}</td>
					<td class="p-3">${data.username}</td>
					<td class="p-3">${data.email}</td>
					<td class="p-3">${data.password}</td>
					<td class="p-3 flex">
						<button class="mr-2 text-white flex items-center bg-[#2E6A27] p-2 rounded-md">
							<i data-lucide="edit-2" class="mr-1"></i>
							Edit
						</button>
						<button class="text-white flex items-center bg-[#E04A4A] p-2 rounded-md">
							<i data-lucide="trash-2" class="mr-1"></i>
							Delete
						</button>
					</td>
				`;

        tableBody.appendChild(row);
      });

      lucide.createIcons();
    </script>

    <script src="../assets/js/toggle-sidebar.js"></script>
    <script src="../assets/js/dropdown.js"></script>
  </body>
</html>