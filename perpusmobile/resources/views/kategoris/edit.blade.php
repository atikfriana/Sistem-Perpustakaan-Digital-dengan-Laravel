@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Kategori: {{ $kategori->nama }}</h2>
    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting: Gunakan metode PUT untuk update --}}

        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori:</label>
            <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror" value="{{ old('nama', $kategori->nama) }}">
            @error('nama')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Kategori
            </button>
            <a href="{{ route('kategoris.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection