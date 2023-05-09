@extends('admin.base')

@section('title', 'Admin: Order')

@section('style')
    <link href="/style/admin/order.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <h2>Order #{{ $order->id }}</h2>

    <h3>Order Items</h3>

    <table class="order-items-table">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Product ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Add Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product->id }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->quantity * $item->product->price }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.addItem', $item->id) }}">
                            @csrf
                            @if($item->is_added)
                                <button type="submit" class="btn btn-disable" disabled>Add Item</button>
                            @else
                                <button type="submit" class="btn btn-primary">Add Item</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
