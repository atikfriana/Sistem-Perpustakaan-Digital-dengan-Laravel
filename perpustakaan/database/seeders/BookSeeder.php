<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Book::create([
        'title' => 'Physics for Beginners',
        'author' => 'John Doe',
        'category_id' => 1, // sesuaikan dengan ID category yang sudah ada
    ]);
         Book::create([
            'title' => 'Filosofi Teras',
            'author' => 'Henry Manampiring',
            'category_id' => 4,
        ]);
    }
}
