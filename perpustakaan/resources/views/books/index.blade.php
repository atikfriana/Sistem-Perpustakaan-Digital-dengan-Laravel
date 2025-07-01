@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
  <h1 class="text-3xl font-bold mb-6">Daftar Buku</h1>

  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('books.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    + Tambah Buku
  </a>

  <table class="w-full border-collapse border border-gray-300">
    <thead>
      <tr class="bg-gray-200">
        <th class="border border-gray-300 p-2 text-left">ID</th>
        <th class="border border-gray-300 p-2 text-left">Judul</th>
        <th class="border border-gray-300 p-2 text-left">Penulis</th>
        <th class="border border-gray-300 p-2 text-left">Kategori</th>
        <th class="border border-gray-300 p-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $book)
      <tr>
        <td class="border border-gray-300 p-2">{{ $book->id }}</td>
        <td class="border border-gray-300 p-2">{{ $book->title }}</td>
        <td class="border border-gray-300 p-2">{{ $book->author }}</td>
        <td class="border border-gray-300 p-2">{{ $book->category->name ?? '-' }}</td>
        <td class="border border-gray-300 p-2">
          <a href="{{ route('books.edit', $book->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
          <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus buku ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" class="text-center p-4">Belum ada buku.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">
    {{ $books->links() }}
  </div>
</div>
@endsection
