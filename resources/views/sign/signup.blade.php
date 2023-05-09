@extends('base')

@section('title', 'Sign up')

@section('style')
<link rel="stylesheet" href="/style/sign.css" type="text/css">
@endsection

@section('content')

    <div class="sign">
        <div class="row">
            <div class="card">
                <div class="card-header">Sign up</div>

                <div class="card-body">
                    <form method="POST" action="/signup" enctype="multipart/form-data">
                        @csrf
                        <div class="input-field">
                            <label for="name">Name</label>
                            <input type="text" id="name" name='name' class="input-text" required>
                        </div>

                        <div class="input-field">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name='email' class="input-text" required>
                        </div>

                        <div class="input-field">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" class="input-text" value="+7" required>
                        </div>


                        <div class="input-field">
                            <label for="password">Password</label>
                            <input type="password" id="password" name='password' class="input-text" required>
                        </div>

                        <div class="submit">
                            <input type="submit" value="Зарегестрироваться" class="input-text" id="subm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $('form').on('submit', function() {
        var phoneInput = $('#phone');
        var phonePattern = /^[+][0-9]{11}$/;
        if (!phonePattern.test(phoneInput.val())) {
            alert('Please enter a valid phone number');
            // return false;
        }
    });
</script>

@endsection
