@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Tambah Buku Baru</h1>

 <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
<!-- Upload Cover -->
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


        <!-- Judul Buku -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Judul Buku</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan judul buku"
                required
            >
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

          <!-- Penulis -->
        <div>
            <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
            <input
                type="text"
                name="author"
                id="author"
                value="{{ old('author') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan nama penulis"
                required
            >
            @error('author')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Penerbit -->
        <div>
            <label for="publisher" class="block text-sm font-medium text-gray-700">Penerbit</label>
            <input
                type="text"
                name="publisher"
                id="publisher"
                value="{{ old('publisher') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan nama penerbit"
                required
            >
            @error('publisher')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Terbit -->
        <div>
            <label for="publication_date" class="block text-sm font-medium text-gray-700">Tanggal Terbit</label>
            <input
                type="date"
                name="publication_date"
                id="publication_date"
                value="{{ old('publication_date') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
            >
            @error('publication_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select
                name="category_id"
                id="category_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
            >
                <option value="" disabled selected>-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div>
            <button
                type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Simpan Buku
            </button>
            <a href="{{ route('books.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Batal</a>
        </div>
    </form>
</div>
@endsection
