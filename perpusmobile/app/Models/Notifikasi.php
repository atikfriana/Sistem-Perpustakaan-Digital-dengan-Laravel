<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasis';
    protected $fillable = [
        'user_id',
        'pesan',
        'dibaca'
    ];

    // Relasi ke user penerima notifikasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
