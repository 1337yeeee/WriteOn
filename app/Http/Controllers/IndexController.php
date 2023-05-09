<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Genres;
use App\Models\Cart;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        $genres = Genres::all();

        $user = Auth::user();
        $products = Cart::setProductInCart($user, $products);
        
        $paginator = ['currentPage' => 1,'lastPage' => 10,];

        return view('index', ['products' => $products, 'genres' => $genres, 'paginator' => $paginator]);
    }
}
