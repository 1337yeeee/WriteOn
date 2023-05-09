<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin: Login</title>
    <link href="/style/admin/auth.css" rel="stylesheet" type="text/css">
    <link href="/style/base.css" rel="stylesheet" />
    <link href="/style/admin/style.css" rel="stylesheet" />
</head>
<body>
    <header>
        <nav class="c">
            <ul class="nav-tabs">
                <li class="nav-element"><a href="/">Home</a></li>
            </ul>
            <ul class="center">
                <li class="nav-tabs b">Admin Panel</li>
            </ul>
            <ul>
                <li class="nav-tabs"></li>
            </ul>
        </nav>
    </header>

    <div class="auth-container">
        <h2>Login</h2>
        <form method="POST" class="auth-form" action="{{ route('admin.auth') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="submit-btn">
                <input class="btn btn-primary" type="submit" value="Login">
            </div>
        </form>
    </div>


<script>
var error = '{{ session('error') }}';
if (error) {
  swal({
    title: 'Sorry',
    text: error,
    icon: 'warning'
  });
}
</script>
</body>
