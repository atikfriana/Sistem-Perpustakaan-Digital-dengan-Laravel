<!-- resources/views/layouts/header-auth.blade.php -->

<header class="flex justify-end items-center gap-6 px-6 py-4 border-b border-gray-300 shadow-[0_2px_4px_rgba(0,0,0,0.1)]">
  <!-- Home -->
<button onclick="location.href='{{ route('home') }}'"class="text-[#0a549d] text-lg">
        <i class="fas fa-home"></i></button>

<!-- Favorites -->
<button onclick="location.href='{{ route('favorit.index') }}'"class="text-[#0a549d] text-lg">
        <i class="fas fa-heart"></i></button>

<!-- Notifications -->
<button onclick="location.href='{{ route('notif') }}'"class="text-[#0a549d] text-lg"> <i class="fas fa-bell"></i></button>

<!-- Riwayat Peminjaman -->
<button onclick="location.href='{{ route('riwayat_peminjaman.index') }}'"class="text-[#0a549d] text-lg flex items-center gap-2 px-2 py-1 hover:text-[#083a7a]">
        <i class="fas fa-book-open"></i></button>


    <!-- Separator -->
    <div class="h-6 border-l border-gray-300"></div>

    <!-- User Info + Dropdown -->
    <div class="relative">
        <div class="flex items-center gap-2 text-[#0a549d] text-sm font-sans cursor-pointer" onclick="toggleDropdown()">
            <div class="w-7 h-7 rounded-full border-2 border-[#0a549d] flex items-center justify-center">
                <i class="fas fa-user-circle text-[#0a549d] text-xl"></i>
            </div>
            <span class="font-normal">Halo,</span>
            <span class="font-bold">{{ Auth::user()->name }}</span>
            <i class="fas fa-chevron-down text-[#0a549d] text-xs"></i>
        </div>

        <!-- Dropdown Menu -->
        <div id="userDropdown" class="absolute right-0 mt-2 w-32 bg-white border rounded shadow hidden z-50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('hidden');
        }
        document.addEventListener('click', function (e) {
            const dropdown = document.getElementById('userDropdown');
            if (!e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</header>
