<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ==============================
// AUTHENTIKASI
// ==============================
Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// ==============================
// HALAMAN UTAMA
// ==============================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==============================
// ADMIN: KATEGORI & BUKU
// ==============================
Route::middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class)->except(['show']);
});

// Halaman Detail Buku (untuk user & admin)
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');


// ==============================
// HALAMAN STATIC (VIEW SAJA)
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/notif', function () {
        return view('notif');
    })->name('notif');

    Route::get('/peminjaman', function () {
        return view('peminjaman');
    })->name('peminjaman');
});

// ==============================
// USER: FITUR AUTHENTIKASI
// ==============================
Route::middleware('auth')->group(function () {

    // FAVORIT
    Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit.index');
    Route::post('/books/{book}/favorite', [FavoriteController::class, 'toggle'])->name('favorit.toggle');

    // PEMINJAMAN
    Route::post('/pinjam', [LoanController::class, 'store'])->name('pinjam.store');
    Route::post('/books/{book}/pinjam', [LoanController::class, 'store'])->name('pinjam');
    Route::get('/riwayat_peminjaman', [LoanController::class, 'index'])->name('riwayat_peminjaman.index');
    Route::post('/riwayat/{loan}/selesai', [LoanController::class, 'markAsReturned'])->name('riwayat_peminjaman.selesai');
});

// ==============================
// FITUR LAIN
// ==============================
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::post('/books/{book}/pinjam', [BookController::class, 'pinjam'])->name('pinjam');
Route::post('/books/{book}/favorit-toggle', [BookController::class, 'toggleFavorit'])->name('favorit.toggle');
use App\Http\Controllers\NotifController;

Route::middleware('auth')->group(function () {
    Route::get('/notif', [NotifController::class, 'index'])->name('notif');
});