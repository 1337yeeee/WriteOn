<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id', 'year', 'img', 'publisher'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function genres()
    {
        $genres = DB::select('SELECT g.genre
                FROM books b
                LEFT JOIN book_genre bg ON bg.book_id = ?
                LEFT JOIN genres g ON bg.genre_id = g.id
                GROUP BY g.id', [$this->id]);
        $this->genres = $genres;
    }
}
