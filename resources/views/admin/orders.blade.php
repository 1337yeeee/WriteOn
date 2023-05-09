@extends('admin.base')

@section('title', 'Admin: Orders List')

@section('style')
    <link href="/style/admin/orders.css" rel="stylesheet" type="text/css">
@endsection

@section('content')

<h2>Orders</h2>

@if (count($orders) > 0)
    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Date Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr onclick="window.location.href='{{ route('admin.order.index', $order->id) }}';">
                    <td>{{ $order->id }}</td>
                    <td>
                        <ul>
                            <li>{{ $order->customer_name }}</li>
                            <li>{{ $order->customer_email }}</li>
                            <li>{{ $order->customer_phone }}</li>
                            <li>{{ $order->customer_address }}</li>
                        </ul>
                    </td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>
                        @if ($order->status == 'created')
                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="in process">
                                <button type="submit" class="btn btn-primary">Process</button>
                            </form>
                        @elseif ($order->status == 'in process')
                            @if($order->canBeDelivered())
                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="in delivery">
                                <button type="submit" class="btn btn-primary">Mark as Delivered</button>
                            </form>
                            @else
                                <button type="button" class="btn btn-warning" onclick="show_warning();">Mark as Delivered</button>
                            @endif
                        @elseif ($order->status == 'in delivery')
                                <button type="submit" class="btn btn-disable" disabled>In Delivery</button>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No orders found.</p>
@endif

<script>
    function show_warning() {
        event.stopPropagation();
        swal({
            title: 'Внимание!',
            text: 'Чтобы отправить заказ, необходимо добавить все товары.',
            icon: 'info'
        });
    }
</script>

@endsection
