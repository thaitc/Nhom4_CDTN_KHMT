<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>
    <link href="/Quanlytruonghoc/resources/css/footer.css" rel="stylesheet">
    <link href="/Quanlytruonghoc/resources/css/header.css" rel="stylesheet">
    <link href="/Quanlytruonghoc/resources/css/menu.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    </style>
</head>
<header>
    <div class="header">
        <div class="logo">
            <a href="{{url('/')}}" class="logo"><img src="/thaitc/logo.png" id="icon" alt="User Icon" /></a>
        </div>
        <div style="float: right;" class="hello">
            @if (Route::has('login'))
            <div class="navbar navbar-expand-lg navbar-light">
                @auth
                <a href="{{ url('/profile') }}">Xin chào {{ Auth::user()->name }}</a>|
                <a href="{{ url('/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
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
    @if (Route::has('login'))
    <div class="topnav" style="padding-left: 10%;" id="myTopnav">
        @auth
        <a href="{{url('/')}}" class="active">Trang chủ</a>
        <a href="{{url('/profile')}}">Hồ sơ</a>
        @if(Auth::user()->level==3)
        <a href="{{url('/thoikhoabieu')}}">Đăng ký tín chỉ</a>
        @endif
        @if( Auth::user()->level==2)
        <a href="{{url('/danhsachlop')}}">Lớp</a>
        @endif
        @else
        @endauth
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars" aria-hidden="true"></i>
        </a>
    </div>
    @endif
    <br />
    <div class="contai">
        @section('content')
        @show
    </div>
</body>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

</html>