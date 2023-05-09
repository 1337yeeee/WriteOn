<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];

    public function items() {
        return $this->hasMany(CartItem::class);
    }

    public function getItem($product_id) {
        $items = $this->items();
        return $items ? $items->where('product_id', $product_id)->first() : null;
    }

    public function order() {
        return $this->hasOne(Order::class)->with('items.product');
    }

    public function total() {
        $items = $this->items()->with('product')->get();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->product->price * $item->quantity;
        }
        return $total;
    }

    public function add($product_id) {
        $item = $this->getItem($product_id);
        if ($item) {
            return $item->add();
        } else {
            CartItem::create([
                'cart_id' => $this->id,
                'product_id' => $product_id,
                'quantity' => 1,
            ]);
            return 1;
        }
    }

    public function dec($product_id) {
        $item = $this->getItem($product_id);
        if ($item) {
            return $item->dec();
        }
    }

    public function deleteItem($product_id) {
        $item = $this->getItem($product_id);
        if ($item) {
            $item->delete();
        }
        $items = $this->items()->get();
        if (count($items) == 0) {
            $this->delete();
        }
    }

    public function hasProduct($product_id) {
        return $this->getItem($product_id) ? true : false;
    }

    public static function setProductInCart($user, $products) {
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                foreach ($products as $product) {
                    if ($cart->hasProduct($product->id)) {
                        $product->in_cart = true;
                    } else {
                        $product->in_cart = false;
                    }
                }
            }
        }
        return $products;
    }

    public static function getOrders($carts) {
        $orders = [];
        foreach ($carts as $cart) {
            $orders[] = $cart->order()->first();
        }

        return $orders;
    }
}
