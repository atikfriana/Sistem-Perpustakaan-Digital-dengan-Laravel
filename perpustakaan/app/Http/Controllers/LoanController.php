<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $loans = $user->loans()->with('book')->latest()->get();

        return view('riwayat_peminjaman', [
            'loans' => $loans,
            'user' => $user
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id'
    ]);

    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Silakan login untuk meminjam buku.');
    }

    $book = Book::findOrFail($request->book_id);

    Loan::create([
        'user_id' => auth()->id(),
        'book_id' => $book->id,
        'tanggal_pinjam' => now(),
        'tanggal_kembali' => now()->addDays(7), // Default 7 hari pinjam
        'jumlah' => 1,
        'selesai' => 0,
    ]);

    return back()->with('success', 'Buku berhasil dipinjam.');
}


    public function selesai(Loan $loan)
{
    if ($loan->user_id !== auth()->id()) {
        abort(403);
    }

    $loan->selesai = 1;
    $loan->save();

    return redirect()->route('riwayat_peminjaman.index')->with('success', 'Buku berhasil dikembalikan.');
}


    public function markAsReturned($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['selesai' => true]);

        return redirect()->back()->with('success', 'Peminjaman diselesaikan.');
    }
}
