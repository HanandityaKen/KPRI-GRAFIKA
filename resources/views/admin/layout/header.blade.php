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
        <img src="{{ Auth::guard('admin')->user()->foto_profile ? asset('storage/' . Auth::guard('admin')->user()->foto_profile) : asset('storage/assets/default-avatar.webp') }}" class="rounded-full w-8 h-8 sm:w-10 sm:h-10" alt="Avatar" />
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
      <div id="userDropdownMenu" class="hidden absolute right-0 top-full mt-2 w-48 bg-white border rounded-lg shadow-lg z-10">
        <ul class="py-0">
          <li>
            <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 hover:bg-gray-100 text-xs">Profile</a>
          </li>
          <li>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-xs">
                    Logout
                </button>
            </form>
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
  </script>
</header>