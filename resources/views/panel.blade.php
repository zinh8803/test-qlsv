<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý điểm sinh viên - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>
    <div class="sidebar">
        <h4>Quản Lý Điểm</h4>
        <a href="#"> Trang chủ</a>
        <a href="#"> Sinh viên</a>
        <a href="#"> Môn học</a>
        <a href="#"> Điểm</a>
        <a href="{{ route('logout') }}"> Đăng xuất</a>
    </div>

    <div class="content">
        <nav class="navbar">
            <span>Xin chào, <strong>{{ $user->name ?? 'Admin' }}</strong></span>
        </nav>

        <div class="container">
            <h3>Hệ thống quản lý điểm sinh viên</h3>
            <p>Chọn mục bên trái để bắt đầu.</p>
        </div>
    </div>
</body>
</html>
