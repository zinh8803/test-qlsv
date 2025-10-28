<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<form method="POST" action="/login">
    @csrf
    <h3>Đăng nhập</h3>
    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
</form>
</body>
</html>
