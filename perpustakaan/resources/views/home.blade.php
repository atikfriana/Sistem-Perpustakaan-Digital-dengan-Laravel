@extends('layouts.app')

@section('content')
  @if(Auth::check())
    @include('layouts.header-auth')
  @else
    @include('layouts.header-guest')
  @endif

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Hero Section -->
  <section class="bg-[#0B3B66] py-16 px-4 sm:px-6 md:px-10 text-center">
    <h1 class="text-white font-semibold text-3xl sm:text-4xl max-w-xl mx-auto leading-tight">
      Sistem Perpustakaan Digital<br/>Multiplatform
    </h1>
    <form id="searchForm" class="mt-8 max-w-xl mx-auto" onsubmit="return false;">
      <label class="sr-only" for="search">Cari Buku</label>
      <input
        class="w-full max-w-xl rounded-md py-2.5 px-4 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white"
        id="search"
        placeholder="Cari Buku"
        type="search"
        autocomplete="off"
      />
    </form>

    <div id="searchResults" class="mt-4 max-w-xl mx-auto text-left text-white"></div>
  </section>

  <!-- Search Script -->
  <script>
    $(document).ready(function() {
      $('#search').on('input', function() {
        let query = $(this).val();

        if (query.length < 2) {
          $('#searchResults').html('');
          return;
        }

        $.ajax({
          url: '{{ route("books.search") }}',
          method: 'GET',
          data: { q: query },
          success: function(response) {
            if (response.length > 0) {
              let html = '<ul class="list-disc pl-5">';
              response.forEach(function(book) {
                html += `<li><strong>${book.title}</strong> - ${book.publisher}</li>`;
              });
              html += '</ul>';
              $('#searchResults').html(html);
            } else {
              $('#searchResults').html('<p>Buku tidak ditemukan.</p>');
            }
          },
          error: function() {
            $('#searchResults').html('<p>Terjadi kesalahan. Coba lagi.</p>');
          }
        });
      });
    });
  </script>

  <!-- Categories -->
  @include('partial.categories', ['categories' => $categories])

  <!-- Books -->
  @include('partial.books', ['books' => $books])

  <!-- Footer -->
  @include('layouts.footer')
@endsection
