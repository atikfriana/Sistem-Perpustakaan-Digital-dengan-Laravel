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
<body class="bg-gray-50">

  {{-- Header --}}
  @if(Auth::check())
    @include('layouts.header-auth')
  @else
    @include('layouts.header-guest')
  @endif

  {{-- Kontainer utama --}}
  <main class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row gap-6">

    {{-- Sidebar (kiri) --}}
    <aside class="w-full md:w-1/4 bg-white rounded-md shadow-md p-6">
      @include('partial.user_nav')
    </aside>

    {{-- Konten Favorit Buku (kanan) --}}
    <section class="w-full md:w-3/4">
      <h2 class="text-xl font-bold mb-4">Favorit Buku</h2>

      @forelse($favorites as $fav)
        <div class="border p-4 rounded mb-4 bg-white shadow-md">
          <div class="flex gap-4">
            <div>
              <p><strong>Judul:</strong> {{ $fav->book->title }}</p>
              <p><strong>Tanggal Terbit:</strong> {{ $fav->book->published_date }}</p>
              <p><strong>Penerbit:</strong> {{ $fav->book->publisher }}</p>
              <form action="{{ route('favorit.toggle', $fav->book->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">Hapus dari Favorit</button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <p class="text-gray-500">Tidak ada buku favorit saat ini.</p>
      @endforelse
      <div class="max-w-3xl flex justify-between items-center mt-12 text-xs text-gray-700">
      <div>Total <span class="font-bold">{{ $fav->count() }}</span> Favorit</div>
      <div class="flex items-center gap-2 select-none">
        <button class="hover:text-gray-900 transition"><i class="fas fa-chevron-left"></i></button>
        <span>1 / 1</span>
        <button class="hover:text-gray-900 transition"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
    </section>

  </main>

</body>
</html>
@include('layouts.footer')