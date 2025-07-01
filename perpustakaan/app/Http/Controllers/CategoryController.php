<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $books = Book::latest()->paginate(10);
    $categories = Category::all();

    return view('categories.index', compact('categories'));
    }

    // Form tambah kategori
    public function create()
    {
        $categories = Category::all();
    return view('categories.create', compact('categories'));
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->only('name'));
        return redirect()->route('categories.index')->with('success', 'Category created');
    }

    // Tampilkan kategori tertentu (bisa dikembangkan)
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Form edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));
        return redirect()->route('categories.index')->with('success', 'Category updated');
    }

    // Hapus kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted');
    }
}
