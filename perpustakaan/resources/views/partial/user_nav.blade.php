<aside class="w-full max-w-xs bg-white rounded-md shadow-md p-6">
  <div class="flex items-center gap-4 mb-6">
    <div class="w-12 h-12 rounded-full bg-gray-400 flex items-center justify-center text-white text-xl font-bold">
      <i class="fas fa-user"></i>
    </div>
    <h2 class="font-bold text-gray-900 text-lg">
      {{ auth()->user()->name ?? 'Pengguna' }}
    </h2>
  </div>

  <hr class="border-gray-200 mb-6" />

  <nav class="space-y-6 text-sm">
    <!-- Favorit -->
    <div class="flex justify-between items-center">
      <a href="{{ route('favorit.index') }}" class="flex items-center gap-2 text-gray-600 hover:text-[#0B4A8B]">
        <i class="far fa-heart"></i>
        <span>Favorit</span>
      </a>
      <span class="font-bold text-gray-900 text-xs">
        {{ auth()->user()->favorites->count() ?? 0 }} Favorit
      </span>
    </div>

    <hr class="border-gray-200" />

    <!-- Riwayat Peminjaman -->
    <div>
      <a href="{{ route('riwayat_peminjaman.index') }}" class="block font-bold text-[#0B4A8B] mb-1 text-sm hover:underline">
        Riwayat Peminjaman
      </a>
      <p class="text-gray-500 text-xs">Status</p>
    </div>

    <hr class="border-gray-200" />

    <!-- Notifikasi -->
    <div>
      <a href="{{ route('notif') }}" class="block font-bold text-[#0B4A8B] mb-1 text-sm hover:underline">
        Notifikasi
      </a>
      <p class="text-gray-500 text-xs">Notifikasi Saya</p>
    </div>
  </nav>
</aside>
