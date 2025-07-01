@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
  <h1 class="text-2xl font-semibold mb-6">Edit Buku</h1>

  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Upload Cover Baru -->
    <div>
      <label for="cover" class="block text-sm font-medium text-gray-700">Cover Buku</label>
      <input type="file" name="cover" id="cover"
        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
               file:rounded-md file:border-0 file:text-sm file:font-semibold
               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
      @error('cover')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="title" class="block font-semibold mb-1">Judul Buku</label>
      <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="border rounded p-2 w-full" />
      @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="author" class="block font-semibold mb-1">Penulis</label>
      <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" class="border rounded p-2 w-full" />
      @error('author')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="publisher" class="block font-semibold mb-1">Penerbit</label>
      <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}" class="border rounded p-2 w-full" />
      @error('publisher')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="publication_date" class="block font-semibold mb-1">Tanggal Terbit</label>
      <input type="date" name="publication_date" id="publication_date" value="{{ old('publication_date', $book->publication_date ? \Carbon\Carbon::parse($book->publication_date)->format('Y-m-d') : '') }}" class="border rounded p-2 w-full" />
      @error('publication_date')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label for="category_id" class="block font-semibold mb-1">Kategori</label>
      <select name="category_id" id="category_id" class="border rounded p-2 w-full">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      @error('category_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
      Update Buku
    </button>
  </form>
</div>
@endsection
