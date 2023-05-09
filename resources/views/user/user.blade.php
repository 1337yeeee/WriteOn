@extends('base')

@section('title', "User: ".Auth::user()->name)

@section('style')
<link href="/style/user/user.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="user-container">
    <div class="col-left">
        <div class="user-info">
            <h2 class="c">Информация о Пользователе</h2>
            <form method="post">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input name="name" id="name" type="text" class="-inactive" readonly required value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <label for="emain">Почта</label>
                    <input name="emain" id="emain" type="text" class="-inactive" readonly required value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input name="phone" id="phone" type="text" class="-inactive" readonly required value="{{ Auth::user()->phone }}">
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input name="address" id="address" type="text" class="-inactive" readonly required value="{{ Auth::user()->address }}">
                </div>
                <div class="form-group button-group">
                    <label for="phone"></label>
                    <button id="edit-btn" class="btn btn-warning" onclick="">Изменить</button>
                    <button id="save-btn" type="submit" class="btn btn-primary d-none" onclick="submit">Сохранить</button>
                </div>
            </form>
        </div>

        <div class="fav-products-container">
            <h2 class="c">Любимые товары</h2>
            <div class="fav-products">
                @foreach($favProducts as $product)
                    <div class="product-card">
                        <div class="card-image">
                            <a href="/product/{{ $product->id }}">
                                <img src="/{{ $product->image }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-details">
                            <div class="card-header">{{ $product->name }}</div>
                            @if ($product->oldprice)
                                <div class="old-price">{{ $product->oldprice }} руб.</div>
                            @else
                                <div class="old-price" style="color: #fff; text-decoration: none;">&nbsp;</div>
                            @endif
                            <div class="card-price">{{ $product->price }} руб.</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-right">
        <h2 class="c">История Заказов</h2>
        <div class="order-container">
            @foreach ($orders as $order)
                <div class="order-item">
                    <div class="order-header">
                        <span>Заказ № {{ $order->id }}</span>
                        <span>{{ $order->created_at->format('d.m H:i') }}</span>
                        <span class="status">`{{ $order->status }}`</span>
                    </div>
                    <div class="order-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Товар</th>
                                    <th class="c">Цена</th>
                                    <th class="c">Кол-во</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('product', $item->product->id) }}">
                                            {{ $item->product->name }}
                                        </a>
                                    </td>
                                    <td class="c">{{ $item->product->price }} руб.</td>
                                    <td class="c">{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="order-footer">
                        <span>Статус обновлен {{ $order->updated_at->format('d.m H:i') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#edit-btn").click(function(event) {
        event.preventDefault();
        $("input.-inactive").removeAttr("readonly").removeClass("-inactive");
        $("#edit-btn").addClass("d-none");
        $("#save-btn").removeClass("d-none");
    });
});
</script>
@endsection
