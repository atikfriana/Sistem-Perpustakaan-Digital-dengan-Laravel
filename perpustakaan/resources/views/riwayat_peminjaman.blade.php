{{-- resources/views/riwayat_peminjaman.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Sistem Perpustakaan Digital Multiplatform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
    .font-playfair {
      font-family: "Playfair Display", serif;
    }
  </style>
</head>
<body>
  @auth
    @include('layouts.header-auth')
  @else
    @include('layouts.header-guest')
  @endauth

<main class="max-w-7xl mx-auto px-6 mt-16 flex flex-col md:flex-row gap-12">
  <aside class="bg-white rounded-md shadow-md w-full max-w-xs p-6 flex flex-col gap-6" style="min-height: 320px">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 rounded-full bg-gray-400 flex items-center justify-center text-white text-lg font-bold">
        <i class="fas fa-user"></i>
      </div>
      <h2 class="font-bold text-gray-900 text-lg">{{ $user->name }}</h2>
    </div>
    <hr class="border-gray-200"/>
    <div class="flex items-center gap-2 text-gray-500 text-sm cursor-pointer hover:text-[#0B4A8B] transition">
      <i class="far fa-heart"></i>
      <span>Favorit</span>
      <span class="ml-auto font-bold text-xs text-gray-900">{{ $user->favorites()->count() }} Favorit</span>
    </div>
    <hr class="border-gray-200"/>
    <div>
      <h3 class="text-[#0B4A8B] font-semibold text-sm mb-1">Riwayat Peminjaman</h3>
      <p class="text-gray-400 text-sm">Status</p>
    </div>
    <hr class="border-gray-200"/>
    <div>
      <h3 class="text-[#0B4A8B] font-semibold text-sm mb-1">Notifikasi</h3>
      <p class="text-gray-400 text-sm">Notifikasi Saya</p>
    </div>
  </aside>

  <section class="flex-1">
    <h2 class="text-[#0B4A8B] font-semibold text-sm mb-6">Riwayat Peminjaman</h2>

    @forelse ($loans as $loan)
      <article class="bg-white rounded-md shadow-md p-4 max-w-3xl mb-6">
        <div class="flex items-center gap-3 text-xs text-gray-500 mb-2">
          <span>{{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</span>
          <span class="bg-{{ $loan->selesai ? 'green' : 'red' }}-300 text-{{ $loan->selesai ? 'green' : 'red' }}-800 rounded-full px-2 py-0.5 font-semibold">
            {{ $loan->selesai ? 'Selesai' : 'Dipinjam' }}
          </span>
        </div>
        <div class="flex gap-4">
          <div class="flex-1">
            <h3 class="text-black font-semibold text-sm leading-tight">{{ $loan->book->title }}</h3>
            <p class="text-xs text-gray-600 mt-1">{{ $loan->book->publisher }}</p>
            <p class="text-xs text-gray-600">Tanggal Pinjam: {{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->format('d M Y') }}</p>
            <p class="text-xs {{ $loan->selesai ? 'text-green-600' : 'text-red-600' }}">
              Kembali Maks: {{ \Carbon\Carbon::parse($loan->tanggal_kembali)->format('d M Y') }}
            </p>
          </div>
          @if (!$loan->selesai)
            <form action="{{ route('riwayat_peminjaman.selesai', $loan->id) }}" method="POST">
              @csrf
              <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Selesai</button>
            </form>
          @else
            <span class="text-green-600 font-semibold">Selesai</span>
          @endif
        </div>
      </article>
    @empty
      <p class="text-center text-gray-500">Belum ada riwayat peminjaman.</p>
    @endforelse

    <div class="max-w-3xl flex justify-between items-center mt-12 text-xs text-gray-700">
      <div>Total <span class="font-bold">{{ $loans->count() }}</span> Riwayat</div>
      <div class="flex items-center gap-2 select-none">
        <button class="hover:text-gray-900 transition"><i class="fas fa-chevron-left"></i></button>
        <span>1 / 1</span>
        <button class="hover:text-gray-900 transition"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </section>
</main>

@include('layouts.footer')
</body>
</html>
