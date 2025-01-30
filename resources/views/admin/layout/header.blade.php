<header class="fixed top-0 bg-white w-full py-5 px-6 sm:px-3 flex z-50">
  <div class="w-full flex justify-between items-center">
    <!-- Hamburger Menu Button -->
    <button class="mobile-menu-button p-2 focus:outline-none" title="Toggle Sidebar" onclick="toggleSidebar()">
      <i data-lucide="menu" class="text-green-800"></i>
    </button>

    <!-- User Avatar with Dropdown -->
    <div class="relative flex items-center space-x-4">
      <a href="#" id="userDropdownToggle" class="flex gap-2 sm:gap-4 items-center justify-end">
        <!-- Avatar Image -->
        <img src="{{ asset('storage/assets/foto_smk.webp')}}" class="rounded-full w-8 h-8 sm:w-12 sm:h-12" alt="Avatar" />
        <!-- User Info -->
        <div class="flex items-center gap-1 sm:gap-2">
          <div class="hidden sm:block">
            <h4 class="text-green-800 font-semibold">{{ auth()->guard('admin')->user()->username }}</h4>
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
  <script>
    document.getElementById("userDropdownToggle").addEventListener("click", function (e) {
      e.preventDefault();
      const dropdown = document.getElementById("userDropdownMenu");
      dropdown.classList.toggle("hidden");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
      const dropdown = document.getElementById("userDropdownMenu");
      const toggleButton = document.getElementById("userDropdownToggle");

      if (!dropdown.contains(e.target) && !toggleButton.contains(e.target)) {
        dropdown.classList.add("hidden");
      }
    });

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

    // Add window resize listener to handle responsive behavior
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
</header>