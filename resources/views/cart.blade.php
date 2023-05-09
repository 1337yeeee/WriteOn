@extends('base')

@section('title', 'Cart')

@section('style')
<link rel="stylesheet" href="/style/cart.css">
@endsection

@section('content')

<div class="cart-container">
    <h1>Your Cart</h1>
    @if(!$cartItems)
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr id="row_item{{$item->product->id}}">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a href="/product/{{$item->product->id}}">{{ $item->product->name }}</a></td>
                        <td>{{ $item->product->price }} руб.</td>
                        <td>
                            <div class="cart-quantity">
                                <button class="btn btn-primary btn-sm" onclick="decFromCart({{ $item->product->id }})">-</button>
                                <span id="quantity{{$item->product->id}}">{{ $item->quantity }}</span>
                                <button class="btn btn-primary btn-sm" onclick="addToCart({{ $item->product->id }})">+</button>
                            </div>
                        </td>
                        <td class="total_prod" id="total{{$item->product->id}}">{{ $item->product->price * $item->quantity }} руб.</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="delFromCart({{ $item->product->id }})">
                                <img src="/img/app/trash.png" alt="Button Image">
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td><strong>Total:</strong></td>
                    <td id="cartTotal">{{ $total }} руб.</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="order-container">
            <div class="make-order">
                <h2>Оформите заказ</h2>
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required
                        {{ isset(Auth::user()->name) ? 'value='.Auth::user()->name : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required
                        {{ isset(Auth::user()->email) ? 'value='.Auth::user()->email : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required
                        {{ isset(Auth::user()->phone) ? 'value='.Auth::user()->phone : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" class="form-control" required
                        @if(isset(Auth::user()->address))
                        value="{{Auth::user()->address}}"
                        @endif>
                    </div>
                    <div class="submit-btn">
                        <input class="btn btn-primary" type="submit" value="Заказать">
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>


<script>
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
                // Update the quantity
                $('#total'+productId).text(response.quantity*response.price + ' руб.');
                $('#quantity'+productId).text(response.quantity);
            } else {
                // Delete table row of the itme
                $('#row_item'+productId).remove();
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
            getTotal();
            // Handle the response
            if (response.quantity > 0) {
                // Update the quantity
                $('#quantity'+productId).text(response.quantity);
                $('#total'+productId).text(response.quantity*response.price + ' руб.');
            } else {
                // Delete table row of the itme
                $('#row_item'+productId).remove();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(productId);
            console.log(errorThrown);
        }
    });
}

function delFromCart(productId) {
    $.ajax({
        type: 'POST',
        url: '{{ route("del.from.cart") }}',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId,
        },
        success: function(response) {
            getTotal();
            $('#row_item'+productId).remove();
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
            $('#cartTotal').text(response.total + " руб.");
            $('#header_cartTotal').text(response.total + " руб.");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Handle the error
            console.log(errorThrown);
        }
    });
}

var is_success = {{(null !==session('success')) ? session('success') : "null"}};
if (is_success == true) {
  swal({
    title: 'Order successful',
    text: 'Your order has been placed successfully!',
    icon: 'success'
  });
}

if (is_success == false) {
  swal({
    title: 'Ошибка',
    text: 'Не получилось оформить заказ.\n\nПопробуйте обновить страницу и оформить заказ снова. Если ошибка появляется снова, обратитесь в поддержку.',
    icon: 'warning'
  });
}
</script>
@endsection
