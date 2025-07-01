<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index() {
    $favorites = auth()->user()->favorites()->with('book')->get();
    return view('favorit', compact('favorites'));
}
    public function toggle(Request $request, Book $book)
    {
        $user = auth()->user();

        $existing = $user->favorites()->where('book_id', $book->id)->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Buku dihapus dari favorit.');
        } else {
            $user->favorites()->create([
                'book_id' => $book->id,
            ]);
            return back()->with('success', 'Buku ditambahkan ke favorit.');
        }
    }

    public function toggleFavorit(Book $book)
{
    $user = auth()->user();

    
    $favorite = $user->favorites()->where('book_id', $book->id)->first();

    if ($favorite) {
        
        $favorite->delete();
        $favorited = false;
    } else {
        
        $user->favorites()->create([
            'book_id' => $book->id,
        ]);
        $favorited = true;
    }
    
    if (request()->ajax()) {
        return response()->json(['favorited' => $favorited]);
    }

    return back();
}

public function store(Request $request)
{
    $request->validate(['book_id' => 'required|exists:books,id']);

    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Silakan login dulu untuk favorit.');
    }

    \App\Models\Favorite::firstOrCreate([
        'user_id' => auth()->id(),
        'book_id' => $request->book_id,
    ]);

    return back()->with('success', 'Buku berhasil ditambahkan ke favorit.');
}

}
