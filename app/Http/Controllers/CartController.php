<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;


class CartController extends Controller
{

    public function index(Request $request) {
        $user = Auth::user();
        $total = 0;
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                // $cartItems = Cart::with('items.product')->find($cart->id)->cartItems;
                $cartItems = $cart->items()->with('product')->get();
                $total = $cart->total();
            } else {
                $cartItems = null;
            }
        } else {
            $cartItems = null;
        }

        return view('cart', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function addItem(Request $request) {
        $product_id = $request->input('product_id');
        $user = Auth::user();
        if ($user) {
            $cart = $user->getCart();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => $user->id,
                    'status' => 'open',
                ]);
            }
            $quantity = $cart->add($product_id);
            return response()->json([
                'success' => true,
                'quantity' => $quantity,
                'price' => Product::find($product_id)->price,
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function decrementItem(Request $request) {
        $product_id = $request->input('product_id');
        $user = Auth::user();
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                $quantity = $cart->dec($product_id);
                return response()->json([
                    'success' => true,
                    'quantity' => $quantity,
                    'price' => Product::find($product_id)->price,
                ]);
            }
        }
        return response()->json(['success' => false]);
    }

    public function deleteItem(Request $request) {
        $product_id = $request->input('product_id');
        $user = Auth::user();
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                $cart->deleteItem($product_id);
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false]);
    }

    public function getTotal() {
        $user = Auth::user();
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                $total = $cart->total();
                return response()->json(['success' => true, 'total' => $total]);
            }
        }
        return response()->json(['success' => false, 'total' => 0]);
    }

    public function getCartTotal() {
        $cart = Cart::where('user_id', Auth::id())->where('status', 'open')->first();
        if ($cart) {
            $total = $cart->total();
        } else {
            $total = 0;
        }
        return $total;
    }

    public function makeOrder(Request $request) {
        $user = Auth::user();
        if ($user) {
            $cart = $user->getCart();
            if ($cart) {
                $order = new Order([
                    'status' => 'created',
                    'cart_id' => $cart->id,
                    'customer_name' => $request->input('name'),
                    'customer_email' => $request->input('email'),
                    'customer_phone' => $request->input('phone'),
                    'customer_address' => $request->input('address'),
                ]);
                $order->save();
                $user->address = $request->input('address');
                $user->save();

                $tmp = $cart->items()->with('product')->get();

                $is_added = $order->addItems($cart->items()->with('product'));
                
                if (!$is_added) {
                    $order->delete();
                    return redirect('/cart')->with('success', false);
                }

                $cart->status = "close";
                if ($cart->save()) {
                    return redirect('/cart')->with('success', true);
                }
            }
        }
        return redirect('/cart')->with('success', false);
    }
}
