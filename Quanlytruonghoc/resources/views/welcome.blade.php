
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
    <link href="/Quanlytruonghoc/resources/css/footer.css" rel="stylesheet">
    <link href="/Quanlytruonghoc/resources/css/header.css" rel="stylesheet">
    <link href="/Quanlytruonghoc/resources/css/menu.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <style>

    </style>
</head>
<header>
    <div class="header">
        <a href="{{url('/')}}" class="logo"><img src="/Quanlytruonghoc/logo.png" id="icon" alt="User Icon" /></a>
        <div class="header">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/profile') }}">Xin chào {{ Auth::user()->name }}</a>
                <a href="{{ url('/logout') }}">Logout</a>
                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </div>
</header>

<body>
    <nav id="fixNav">
        @if (Route::has('login'))
        <div style="padding-left:10% ;">
            @auth
            <ul>
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li><a href="{{url('/thoikhoabieu')}}">Đăng ký tín chỉ</a></li>
                <li><a href="{{url('/profile')}}">Hồ sơ</a></li>
                @if(Auth::user()->level==1 || Auth::user()->level==2)
                <li><a href="#">Lớp</a></li>
                @endif
            </ul>
            @else
            @endauth
        </div>
        @endif
    </nav>
    <br />
    <div class="contai">
        @section('content')
        @show
    </div>
</body>

</html>