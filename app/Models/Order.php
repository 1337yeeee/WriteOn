<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'cart_id',
        'customer_name', 'customer_email',
        'customer_phone', 'customer_address'
    ];

    public function addItems($itemsQuery) {
        if ($itemsQuery) {$items = $itemsQuery->get();}
        else {return false;}
        
        foreach($items as $item) {
            $order_item = OrderItem::create([
                'order_id' => $this->id,
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
            if (!$order_item) {return false;}
        }

        return true;
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function canBeDelivered() {
        foreach ($this->items as $item) {
            if (!$item->is_added) {
                return false;
            }
        }
        return true;
    }
}
