<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'author',            
    'publisher',
    'publication_date',     
    'cover_url',
    'category_id',
    'stock',
    'total',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

public function favorites() {
    return $this->hasMany(Favorite::class);
}
public function loans() {
    return $this->hasMany(Loan::class);
}

}

