<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @yield('style')
    <link href="/style/base.css" rel="stylesheet" />
    <link href="/style/admin/style.css" rel="stylesheet" />
</head>
<body>
    <header>
        <nav class="header">
            <ul>
                <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li><a href="{{ route('admin.import.index') }}">Import</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="/js/jQuery.js"></script>
<script src="/js/sweetalert.js"></script>
</body>
</html>
