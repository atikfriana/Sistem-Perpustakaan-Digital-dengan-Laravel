<!-- resources/views/layouts/header-guest.blade.php -->

<header class="flex justify-end items-center gap-4 px-6 py-4 border-b border-gray-300 shadow-[0_2px_4px_rgba(0,0,0,0.1)]">
    <button onclick="location.href='{{ route('login') }}'" 
        class="text-[#0a549d] font-medium text-sm hover:underline">
        Masuk
    </button>

    <button onclick="location.href='{{ route('register') }}'" 
        class="bg-[#0a549d] text-white px-4 py-1 rounded-full text-sm hover:bg-[#083a7a]">
        Daftar
    </button>
</header>
