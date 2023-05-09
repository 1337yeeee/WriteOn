@extends('base')

@section('title', 'Sign in')

@section('style')
<link rel="stylesheet" href="/style/sign.css" type="text/css">
@endsection

@section('content')

	<div class="sign">
        <div class="row">
            <div class="card">
                <div class="card-header">Sign in</div>

                <div class="card-body">
                    <form method="POST" action="/signin" enctype="multipart/form-data">
                        @csrf
                        <div class="input-field">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name='email' class="input-text" required>
                        </div>

                        <div class="input-field">
                            <label for="password">Password</label>
                            <input type="password" id="password" name='password' class="input-text" required>
                        </div>

                        <div class="submit">
                            <input type="submit" value="Авторизироваться" class="input-text" id="subm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection