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

  {{-- Main Container with Sidebar & Content --}}
  <main class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row gap-10">

    {{-- Sidebar di kiri --}}
    <aside class="w-full md:w-1/4 bg-white rounded-md shadow-md p-6">
      @include('partial.user_nav')
    </aside>

    {{-- Konten Notifikasi di kanan --}}
    <section class="w-full md:w-3/4">
  <h2 class="text-xl font-bold mb-4">Notifikasi Peminjaman Hari Ini</h2>

  @foreach($notifs as $loan)
  <div class="border p-3 rounded mb-2 bg-white shadow">
    <p><strong>{{ $loan->book->title }}</strong></p>
    <p>Kembalikan sebelum: 
      <span class="text-red-600">
        {{ \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7)->format('d M Y') }}
      </span>
    </p>
  </div>
@endforeach

</section>


  </main>

</body>
</html>
@include('layouts.footer')