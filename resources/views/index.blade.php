@extends('base')

@section('title', 'Write On!')

@section('style')
<link href="/style/products.css" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="main">
    @if(isset($search_query))
    <div class="search-info">
        <h1 class="search-query"><span>Результаты поиска:</span> {{$search_query}}</h1>
    </div>
    @endif
    <div class="left-container">
        <div class="left-menu">
            <form method="GET" action="/search">
                @if(isset($search_query))
                <input type="text" name="query" hidden="true" readonly value="{{ $search_query }}">
                @endif
                <div class="filter-input">
                    <label for="max_price">цена ДО</label>
                    <input type="number" name="max_price" id="max_price" step="100"
                    {{isset($_REQUEST['max_price']) ? "value=".$_REQUEST['max_price'] : ''}}>
                </div>
                <div class="filter-input">
                    <label for="min_price">цена ОТ</label>
                    <input type="number" name="min_price" id="min_price" step="100"
                    {{isset($_REQUEST['min_price']) ? "value=".$_REQUEST['min_price'] : ''}}>
                </div>
                <div class="filter-input">
                    <label for="sorting">Choose sorting:</label>
                    <select id="sorting" name="sorting">
                        <option value="none" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] != 'none' ? '' : 'selected' }}>--------------------</option>
                        <option value="abc" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'abc' ? 'selected' : '' }}>In alphabetical order</option>
                        <option value="abc_r" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'abc_r' ? 'selected' : '' }}>In reverse alphabetical order</option>
                        <option value="pricedec" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'pricedec' ? 'selected' : '' }}>By decreasing price</option>
                        <option value="priceinc" {{isset($_REQUEST['sorting']) && $_REQUEST['sorting'] == 'priceinc' ? 'selected' : '' }}>By increasing price</option>
                    </select>
                </div>
                @if(isset($genres))
                    <div class='filter-devider'></div>
                    @foreach($genres as $genre)
                    <div class="filter-input checkbox">
                        <label for="genre{{$genre->id}}">{{$genre->genre}}</label>
                        <input type="checkbox" name="genre[]" id="genre{{$genre->id}}" value="{{$genre->id}}" {{ isset($_REQUEST['genre']) ? (in_array($genre->id, $_REQUEST['genre']) ? 'checked' : '') : '' }}>
                    </div>
                    @endforeach
                @endif
                <div class="filter-submit">
                    <input type="submit" value="Apply">
                </div>
            </form>
        </div>
    </div>

    <div class="content products">
        @foreach($products as $product)
            <div class="book-card">
                <div class="card-image">
                    <a href="/product/{{ $product->id }}">
                        <img src="/{{ $product->image }}" alt="{{ $product->name }}">
                    </a>
                </div>
                <div class="card-details">
                    @if ($product->oldprice)<p class="old-price">{{ $product->oldprice }}</p>
                    @else
                    <p class="old-price" style="color: #fff; text-decoration: none;">&nbsp;</p>
                    @endif
                    <p class="price">{{ $product->price }} руб.</p>
                    <h2 class="product-name">{{ $product->name }}</h2>
                    @if (isset($product->in_cart) and $product->in_cart)
                    <button class="btn-product-active" onclick="location.href='/product/{{ $product->id }}'">Добавлен</button>
                    @else
                    <button class="btn-product" onclick="addToCart({{ $product->id }})">Добавить в корзину</button>
                    @endif
                </div>
            </div>
            <!-- </div> -->
        @endforeach
    </div>
</div>

@if ($products->lastPage() > 1)
    <div class="pagination">
        <ul>
            @if($products->currentPage() == 1)
                <li class="disabled">&laquo;</li>
            @else
                <li><a href="{{ $products->url($products->currentPage()-1) }}">&laquo;</a></li>
            @endif

            @if($products->currentPage() > 3)
                <li><a href="{{ $products->url(1) }}">1</a></li>
                <li class="disabled"><span>...</span></li>
            @endif

            @for ($i = max(1, $products->currentPage() - 2); $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)
                @if ($i == $products->currentPage())
                    <li class="active"><span>{{ $i }}</span></li>
                @else
                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            @if($products->currentPage() < $products->lastPage() - 2)
                <li class="disabled"><span>...</span></li>
                <li><a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
            @endif

            @if($products->currentPage() == $products->lastPage())
                <li class="disabled">&raquo;</li>
            @else
                <li><a href="{{ $products->url($products->currentPage()+1) }}">&raquo;</a></li>
            @endif
        </ul>
    </div>
@endif


<script>
function addToCart(productId) {
    var is_user = {{ Auth::check() ? 'true' : 'false' }};

    if (is_user) {
        $.ajax({
            type: 'POST',
            url: '{{ route("add.to.cart") }}',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
            },
            success: function(response) {
                changeButton(productId);
                getTotal();
                if (response.quantity > 0) {
                } else {
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error
                console.log(productId);
                console.log(errorThrown);
            }
        });
    } else {
        swal({
            title: "Пожалуйста, авторизуйтесь или зарегистрируйтесь в нашем магазине",
            icon: "info",
            button: "OK",
        });
    }
}

function changeButton(productId) {
    var button = $(`button[onclick="addToCart(${productId})"]`);
    button.removeClass('btn-product');
    button.addClass('btn-product-active');
    button.text('Добавлен');

    // Change the onclick attribute to act as a link
    button.attr('onclick', `location.href='/product/${productId}'`);
}

function getTotal() {
    $.ajax({
        type: 'POST',
        url: '{{ route("get.total") }}',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            $('#header_cartTotal').text(response.total + " руб.");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(errorThrown);
        }
    });
}
</script>

@endsection
