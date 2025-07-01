@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Daftar Kategori</h1>

    <a href="{{ route('categories.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Kategori</a>

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td class="px-4 py-2 border">{{ $category->id }}</td>
                <td class="px-4 py-2 border">{{ $category->name }}</td>
                <td class="px-4 py-2 border">
                    <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:underline ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
