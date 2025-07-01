<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Tampilkan semua buku
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10); // paginate
    return view('books.index', compact('books'));
    }

    // Form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Simpan buku baru
   public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'publication_date' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Simpan cover jika ada
    $coverPath = null;
    if ($request->hasFile('cover')) {
        $coverPath = $request->file('cover')->store('covers', 'public');
    }

    // Simpan ke database
    Book::create([
        'title' => $validated['title'],
        'author' => $validated['author'],
        'publisher' => $validated['publisher'],
        'publication_date' => $validated['publication_date'],
        'category_id' => $validated['category_id'],
        'cover_url' => $coverPath, // simpan path cover jika ada
    ]);

    return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
}


  



    // Tampilkan detail buku
   public function show(Book $book)
{
    return view('detail', compact('book'));
}




    // Form edit buku
    public function edit(Book $book)
{
    $categories = Category::all();
    return view('books.edit', compact('book', 'categories'));
}



    // Update buku
   public function update(Request $request, Book $book)
{
    $request->validate([
    'title' => 'required|string|max:255',
    'author' => 'required|string|max:255',
    'publisher' => 'required|string|max:255',
    'publication_date' => 'required|date',
    'category_id' => 'required|exists:categories,id',
    'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
]);

    if ($request->hasFile('cover')) {
    $coverName = time() . '.' . $request->cover->extension();
    $request->cover->storeAs('public/covers', $coverName);
    $book->cover_url = $coverName;
}

    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'publisher' => $request->publisher,
        'publication_date' => $request->publication_date,
        'category_id' => $request->category_id,
    ]);

    $book->save();

    return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
}


    // Hapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted');
    }

    public function search(Request $request)
{
    $query = $request->q;

    $books = Book::where('title', 'like', "%{$query}%")
             ->orWhere('publisher', 'like', "%{$query}%")
             ->limit(10)
             ->get(['id', 'title', 'publisher']);

    return response()->json($books);
}
    public function pinjam(Book $book)
{
    $user = auth()->user();

    if(request()->ajax()){
        return response()->json(['message' => 'Berhasil meminjam buku']);
    }

    return back()->with('success', 'Buku berhasil dipinjam');
}


    public function toggleFavorit(Book $book)
    {
        $user = auth()->user();

        // Cari record Favorite jika sudah ada
        $favorite = $user->favorites()->where('book_id', $book->id)->first();

        if ($favorite) {
            // Hapus record Favorite
            $favorite->delete();
            $favorited = false;
        } else {
            // Buat record Favorite baru
            $user->favorites()->create([
                'book_id' => $book->id,
            ]);
            $favorited = true;
        }

        if (request()->ajax()) {
            return response()->json(['favorited' => $favorited]);
        }

        return back()->with('success', $favorited
            ? 'Buku ditambahkan ke favorit.'
            : 'Buku dihapus dari favorit.');
    }
}