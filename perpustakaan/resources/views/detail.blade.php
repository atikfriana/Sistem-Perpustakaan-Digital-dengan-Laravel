@extends('layouts.app') 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Detail Buku - {{ $book->title }}</title>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
  @auth
    @include('layouts.header-auth')
  @else
    @include('layouts.header-guest')
  @endauth

  <main class="max-w-6xl mx-auto mt-10 px-4">
    <div class="bg-white shadow-md rounded-md p-6 flex flex-col md:flex-row gap-6">
      <img src="{{ $book->cover_url }}" alt="Cover {{ $book->title }}" class="w-40 h-60 object-cover rounded">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h1>
        <p class="text-gray-600 mt-2">Kategori: {{ $book->category->name ?? 'Tidak diketahui' }}</p>
        <p class="text-gray-600">Penerbit: {{ $book->publisher }}</p>
        <p class="text-gray-600">Tanggal Terbit: {{ \Carbon\Carbon::parse($book->published_at)->format('d M Y') }}</p>
        <div class="mt-4 flex gap-2">

          @auth
            @php
              $sedangDipinjam = \App\Models\Loan::where('user_id', auth()->id())
                                ->where('book_id', $book->id)
                                ->where('selesai', false)
                                ->exists();

              $favorited = auth()->user()->favorites()->where('book_id', $book->id)->exists();
            @endphp

            {{-- Tombol Pinjam Buku atau Sudah Dipinjam --}}
            @if($sedangDipinjam)
              <button class="bg-gray-400 text-white font-extrabold text-lg rounded px-4 py-2 w-full md:w-auto cursor-not-allowed" disabled>
                <i class="fas fa-clock"></i> Sedang Dipinjam
              </button>
            @else
              <form action="{{ route('pinjam.store') }}" method="POST" class="w-full md:w-auto">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="bg-blue-500 text-white font-extrabold text-lg rounded px-4 py-2 w-full md:w-auto">
                  <i class="fas fa-book"></i> Pinjam Buku
                </button>
              </form>
            @endif

            {{-- Tombol Favorit --}}
            <form id="favoriteForm" action="{{ route('favorit.toggle', $book->id) }}" method="POST" class="w-full md:w-auto">
              @csrf
              <button id="favoriteBtn" type="submit"
                class="text-white font-extrabold text-lg rounded px-4 py-2 w-full md:w-auto
                  {{ $favorited ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-500 hover:bg-gray-600' }}">
                {{ $favorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
              </button>
            </form>
          @else
            <p class="text-sm text-red-500">Silakan login untuk meminjam atau menyimpan favorit.</p>
          @endauth

        </div>
      </div>
    </div>
  </main>

  @include('layouts.footer')

  <script>
    $(document).ready(function(){
      $('#favoriteForm').submit(function(e){
        e.preventDefault();
        let form = $(this);
        $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: form.serialize(),
          success: function(response){
            if (response.favorited) {
              $('#favoriteBtn')
                .removeClass('bg-gray-500 hover:bg-gray-600')
                .addClass('bg-red-500 hover:bg-red-600')
                .text('Hapus dari Favorit');
            } else {
              $('#favoriteBtn')
                .removeClass('bg-red-500 hover:bg-red-600')
                .addClass('bg-gray-500 hover:bg-gray-600')
                .text('Tambah ke Favorit');
            }
          },
          error: function(){
            alert('Gagal update favorit, coba lagi.');
          }
        });
      });
    });
  </script>
</body>
</html>
