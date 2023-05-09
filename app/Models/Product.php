<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'oldprice', 'price'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function fromArray($array) {
        $products = [];
        foreach($array as $id) {
            $products[] = Product::find($id);
        }

        return $products;
    }
}
