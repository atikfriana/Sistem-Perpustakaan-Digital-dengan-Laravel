<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($books as $book)
    <article class="bg-white border border-gray-200 rounded-lg p-4 flex flex-col relative 
    hover:shadow-lg hover:-translate-y-1 transition-transform duration-200">
        
        <!-- Buat seluruh kartu bisa diklik ke halaman detail -->
        <a href="{{ route('books.show', $book->id) }}" class="absolute inset-0 z-0"></a>

        <!-- Konten buku -->
        <img src="{{ asset('storage/' . $book->cover_url) }}" alt="Cover {{ $book->title }}" class="h-40 object-contain mb-3 rounded z-10 relative" />
        <h3 class="font-semibold text-sm mb-1 z-10 relative">{{ $book->title }}</h3>
        <p class="text-xs text-gray-500 z-10 relative">{{ $book->publisher }}</p>
        <p class="text-xs text-gray-400 z-10 relative">{{ \Carbon\Carbon::parse($book->published_date)->format('M d, Y') }}</p>

        @auth
        <!-- Tombol favorit tetap bisa diklik -->
        <form action="{{ route('favorit.toggle', $book) }}" method="POST" class="mt-auto z-10 relative">
            @csrf
            @php
                $favorited = auth()->user()->favorites->contains('book_id', $book->id);
            @endphp
            <button type="submit" 
                class="w-full text-center rounded px-3 py-1 text-xs font-semibold
                {{ $favorited ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-gray-300 text-gray-700 hover:bg-gray-400' }}">
                {{ $favorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
            </button>
        </form>
        @else
            <p class="text-xs mt-auto text-gray-400 z-10 relative">Login untuk favorit</p>
        @endauth
        
    </article>
    @endforeach
</div>
