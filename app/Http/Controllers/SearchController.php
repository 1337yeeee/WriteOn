<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Genres;
use App\Models\Cart;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('query');

        $genres = Genres::all();

        $products = $this->filter($request)->paginate(6);
        $products->appends($request->query());

        $user = Auth::user();
        $products = Cart::setProductInCart($user, $products);

        return view('index', [
            'products' => $products,
            'genres' => $genres,
            'search_query' => $query,
        ]);
    }

    public function filter(Request $request) {
        $query = $request->input('query');
        $maxPrice = $request->input('max_price');
        $minPrice = $request->input('min_price');
        $order = $request->input('sorting');
        $selectedGenres = $request->input('genre', []);

        $products = DB::table('products as p')
            ->select('p.*')
            ->join('books as b', 'p.book_id', '=', 'b.id')
            ->join('authors as a', 'b.author_id', '=', 'a.id')
            ->when($query, function ($query, $queryTerm) {
                $query->where(function ($query) use ($queryTerm) {
                    $query->whereRaw('LOWER(p.name) LIKE ?', ["%{$queryTerm}%"])
                        ->orWhereRaw('LOWER(a.name) LIKE ?', ["%{$queryTerm}%"])
                        ->orWhereRaw('LOWER(p.description) LIKE ?', ["%{$queryTerm}%"]);
                });
            })
            ->when($minPrice !== null, function ($query) use ($minPrice) {
                $query->where('p.price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($query) use ($maxPrice) {
                $query->where('p.price', '<=', $maxPrice);
            })
            ->when($selectedGenres, function ($query, $selectedGenres) {
                $query->whereIn('b.id', function ($subQuery) use ($selectedGenres) {
                    $subQuery->select('book_id')
                        ->from('book_genre')
                        ->whereIn('genre_id', $selectedGenres);
                });
            })
            ->when($order == 'abc', function ($query) {
                $query->orderBy('p.name');
            })
            ->when($order == 'abc_r', function ($query) {
                $query->orderBy('p.name', 'desc');
            })
            ->when($order == 'pricedec', function ($query) {
                $query->orderBy('p.price', 'desc');
            })
            ->when($order == 'priceinc', function ($query) {
                $query->orderBy('p.price');
            });

        return $products;
    }
}
