<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi pemesanan buku oleh user
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    // Relasi peminjaman buku oleh user
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // Relasi notifikasi untuk user
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }
}
