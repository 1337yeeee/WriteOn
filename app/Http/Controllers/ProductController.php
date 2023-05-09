<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($product_id) {
        $product = Product::with('book.author')->find($product_id);

        if (isset($product->book)) {
            $product->book->genres();
        }

        if (!$product) {
            return redirect('/');
        }
        $user = Auth::user();
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                $item = $cart->getItem($product_id);
                if($item) {
                    return view('product', ['product' => $product, 'quantity' => $item->quantity]);
                }
            }
        }
        return view('product', ['product' => $product, 'quantity' => 0]);
    }
}
