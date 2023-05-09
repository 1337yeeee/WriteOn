<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @yield('style')
    <link href="/style/base.css" rel="stylesheet" />
    <link href="/style/style.css" rel="stylesheet" />
</head>
<body>
    <header>
        <nav class="header">
            <ul class="nav-tabs">
                <li class="nav-element"><a href="/">Home</a></li>
                <li class="nav-element"><a href="#">About</a></li>
                <li class="nav-element"><a href="#">Contact</a></li>
            </ul>

            <form class="search-form" method="GET" action="/search">
                <input type="text" name="query" placeholder="Search" {{ isset($search_query) ? "value=".$search_query : ""}}>
                <input type="number" name="max_price" id="max_price" hidden="true" readonly {{isset($_REQUEST['max_price']) ? "value=".$_REQUEST['max_price'] : ''}}>
                <input type="number" name="min_price" id="min_price" hidden="true" readonly {{isset($_REQUEST['min_price']) ? "value=".$_REQUEST['min_price'] : ''}}>
                <select id="sorting" name="sorting" hidden="true" readonly>
                    <option value="none" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] != 'none' ? '' : 'selected' }}>--------------------</option>
                    <option value="abc" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'abc' ? 'selected' : '' }}>In alphabetical order</option>
                    <option value="abc_r" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'abc_r' ? 'selected' : '' }}>In reverse alphabetical order</option>
                    <option value="pricedec" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'pricedec' ? 'selected' : '' }}>By decreasing price</option>
                    <option value="priceinc" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'priceinc' ? 'selected' : '' }}>By increasing price</option>
                </select>
                @if(isset($genres))
                    @foreach($genres as $genre)
                    <input type="checkbox" name="genre[]" id="genre{{$genre->id}}" value="{{$genre->id}}" {{ isset($_REQUEST['genre']) ? (in_array($genre->id, $_REQUEST['genre']) ? 'checked' : '') : '' }} hidden="true" readonly>
                    @endforeach
                @endif
                <button class="btn" type="submit">Search</button>
            </form>

            @if (Auth::check())
            <ul class="nav-tabs">
                <li class="nav-element">
                    <a href="/cart">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><title>Winkelwagen</title><path fill-rule="evenodd" d="M33.5 38.25a.75.75 0 0 1 0 1.5.75.75 0 0 1 0-1.5zm-3 .75c0 1.654 1.346 3 3 3s3-1.346 3-3-1.346-3-3-3-3 1.346-3 3zM9 39.891a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5zm0-3.9c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3zm27.953-10.715l-5.166.163.205-5.939h6.575l-.235 4.381c-.052.755-.66 1.354-1.379 1.395zm-21.05-1.439l-.932-4.337h6.53v6.264l-5.49.173c.057-.695.03-1.4-.108-2.1zM19 13h2.5v5h-6.853l-1.224-5.696C14.791 12.696 16.61 13 19 13zm11.49 6.5l-.206 5.986-7.284.23V19.5h7.49zm.225-6.5l-.173 5H23v-5h7.715zm7.933 5h-6.604l.172-5h6.701l-.269 5zm2.941-7.532A1.5 1.5 0 0 0 40.5 10H19c-3.474 0-5.422-.717-6.328-1.187l-.085-.395A3.077 3.077 0 0 0 9.595 6H6v3l3.653.048 3.312 15.392a4.502 4.502 0 0 1-.803 3.551l-1.836 2.361a3.478 3.478 0 0 0-.382 3.686A3.479 3.479 0 0 0 13.09 36h23.36v-3H13.09a.479.479 0 0 1-.45-.28.482.482 0 0 1 .053-.527l1.852-2.381c.202-.269.378-.554.541-.845l21.997-.694a4.512 4.512 0 0 0 4.243-4.21l.672-12.482a1.503 1.503 0 0 0-.409-1.113z"/></svg>
                    </a>
                </li>
                @php
                    $cart_total = app('App\Http\Controllers\CartController')->getCartTotal();
                @endphp
                @if ($cart_total)
                <li class="nav-element" id="header_cartTotal">{{ $cart_total }} руб.</li>
                @else
                <li class="nav-element" id="header_cartTotal"></li>
                @endif
            </ul>
            @endif

            @if (Auth::check())
                <ul class="nav-tabs">
                    <li class="nav-element">
                        <a class="user-page" href="{{ route('user.index') }}">{{Auth::user()->name}}</a>
                    </li>
                    <li class="nav-element">
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="btn">Log Out</button>
                        </form>
                    </li>
                </ul>
            @else
                <ul class="nav-tabs">
                    <li class="nav-element"><a href="signin" class="btn">Sign In</a></li>
                    <li class="nav-element"><a href="signup" class="btn">Sign Up</a></li>
                </ul>
            @endif
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>

@yield('scripts')
<script src="/js/jQuery.js"></script>
<script src="/js/sweetalert.js"></script>
</body>
</html>
