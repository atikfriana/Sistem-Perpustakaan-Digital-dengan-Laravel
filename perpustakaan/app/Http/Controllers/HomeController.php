<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::with('category') // ← gunakan relasi yang benar (category, bukan categories)
            ->when($search, fn($q) => $q->where('title', 'like', "%$search%"))
            ->latest()
            ->paginate(10);

        $categories = Category::all(); // ← pastikan ini disediakan untuk view

        return view('home', compact('books', 'categories')); // ← ini mengirim dua variabel
    }
}
