<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jumlah',
        'selesai'
    ];

    protected $dates = ['tanggal_pinjam', 'tanggal_kembali'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getIsReturnedAttribute() {
    return $this->selesai == 1;
        }

        public function getDueDateAttribute() {
            return $this->tanggal_kembali ?? $this->tanggal_pinjam?->copy()->addDays(7);
        }
}
