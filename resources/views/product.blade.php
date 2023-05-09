@extends('base')

@section('title', $product->name)

@section('style')
<link href="/style/product.css" rel="stylesheet" />
@endsection

@section('content')

<div class="product">
    <div class="product-image">
        <img src="/{{ $product->image }}" alt="{{ $product->name }}">
    </div>
    <div class="product-info">
        @if ($product->book)
            <h1 class="product-title">{{ $product->book->title }}</h1>
            <a class="author-name" href="/author/{{$product->book->author->id}}">{{ $product->book->author->name }}</a>
            <p class="year">{{ $product->book->year }}</p>
            <p class="publisher">{{ $product->book->publisher }}</p>
            <p class="genre">{{ implode(', ', array_column($product->book->genres, 'genre')) }}</p>
        @else
            <h1 class="product-name_big">{{ $product->name }}</h1>
            <p class="product-description">{{ $product->description }}</p>
        @endif
        
        <div class="price-and-buy">
            <div class="product-price">
                @if ($product->oldprice)<div class="old-price">${{ $product->oldprice }}</div>
                @else
                <div class="old-price" style="color: #fff; text-decoration: none;">&nbsp;</div>
                @endif
                <div class="product-currentprice">{{ $product->price }} руб.</div>
            </div>
                <div class="cart-things" id="quantNull">   
                    <button class="btn btn-primary" onclick="addToCart({{$product->id}})">Добавить в корзину</button>
                </div>
                <div class="cart-things" id="quantIs">   
                    <button class="btn-dec btn" onclick="decFromCart({{$product->id}})">-</button>
                    <p id="quantity">{{ $quantity }}</p>
                    <button class="btn-add btn" onclick="addToCart({{$product->id}})">+</button>
                </div>
        </div>
    </div>
</div>
@if ($product->book)
<div class="product-container">
    <p class="description">
        {{ $product->description }}
    </p>
</div>
@endif

<script>
$(document).ready(function() {
  var quantity = parseInt($('#quantity').text());
  if (quantity == 0) {
    $('#quantNull').show();
    $('#quantIs').hide();
  } else {
    $('#quantNull').hide();
    $('#quantIs').show();
  }
});

function addToCart(productId) {
    $.ajax({
        type: 'POST',
        url: '{{ route("add.to.cart") }}',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
        },
        success: function(response) {
            getTotal();
            // Handle the response
            if (response.quantity > 0) {
                // Update the quantity and show the +/- buttons
                $('#quantity').text(response.quantity);
                $('#quantNull').hide();
                $('#quantIs').show();
            } else {
                // Show the big button
                $('#quantity').text(response.quantity);
                $('#quantNull').show();
                $('#quantIs').hide();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(productId);
            console.log(errorThrown);
        }
    });
}

function decFromCart(productId) {
    $.ajax({
        type: 'POST',
        url: '{{ route("dec.from.cart") }}',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
        },
        success: function(response) {
            getTotal()
            // Handle the response
            if (response.quantity > 0) {
                // Update the quantity
                $('#quantity').text(response.quantity);
                $('#quantNull').hide();
                $('#quantIs').show();
            } else {
                // Show the big button
                $('#quantity').text(response.quantity);
                $('#quantNull').show();
                $('#quantIs').hide();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(productId);
            console.log(errorThrown);
        }
    });
}

function getTotal() {
    $.ajax({
        type: 'POST',
        url: '{{ route("get.total") }}',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            var total = parseFloat(response.total).toFixed(2);
            var formattedTotal = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(total);
            $('#cartTotal').text(formattedTotal);
            $('#header_cartTotal').text(formattedTotal);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(errorThrown);
        }
    });
}
</script>

@endsection
