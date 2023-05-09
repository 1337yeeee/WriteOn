<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();
        if($user) {
            $orders = $user->getOrders();
            $favProducts_id = DB::table('order_items AS oi')
                ->leftJoin('orders AS o', 'o.id', '=', 'oi.order_id')
                ->leftJoin('carts AS c', 'c.id', '=', 'o.cart_id')
                ->where('c.user_id', $user->id)
                ->where('c.status', 'close')
                ->groupBy('oi.id')
                ->select('oi.product_id', DB::raw('SUM(oi.quantity) AS frequency'), 'oi.created_at')
                ->orderByDesc('frequency')
                ->orderByDesc('oi.created_at')
                ->limit(3)
                ->pluck('product_id')
                ->toArray();

            $favProducts = Product::fromArray($favProducts_id);

            return view('user.user', compact('orders', 'favProducts'));            
        }

        return redirect('/');
    }
}
