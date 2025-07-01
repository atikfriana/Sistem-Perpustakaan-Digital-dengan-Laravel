@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Tambah Kategori Baru</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                placeholder="Masukkan nama kategori"
                required
            >
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button
                type="submit"
                class="py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Simpan
            </button>
            <a href="{{ route('categories.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Batal</a>
        </div>
    </form>
</div>
@endsection
