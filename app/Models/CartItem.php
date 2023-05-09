<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function add() {
        $this->quantity += 1;
        $this->save();
        return $this->quantity;
    }

    public function dec() {
        if ($this->quantity <= 1) {
            $this->delete();
            return 0;
        } else {
            $this->quantity -= 1;
            $this->save();
            return $this->quantity;
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
