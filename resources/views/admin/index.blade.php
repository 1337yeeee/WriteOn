@extends('admin.base')

@section('title', 'Admin: Index')

@section('style')
    <link href="/style/admin/index.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    {{-- <div class="welcome-container"> --}}
        <div class="welcome">
            Welcome, {{ $user->name }}
        </div>
    {{-- </div> --}}
@endsection