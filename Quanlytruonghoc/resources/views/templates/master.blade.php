<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> @yield('title')</title>
	<link href="/Quanlytruonghoc/resources/css/footer.css" rel="stylesheet">
	<link href="/Quanlytruonghoc/resources/css/header.css" rel="stylesheet">
	<link href="/Quanlytruonghoc/resources/css/menu.css" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//path/to/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
</head>
<header>
	<div class="header">
		<a href="{{url('/')}}" class="logo"><img src="/Quanlytruonghoc/logo.png" id="icon" alt="User Icon" /></a>
		<div class="header">
			@if (Route::has('login'))
			<div class="top-right links">
				@auth
				<a href="{{ url('/') }}">Xin chào {{ Auth::user()->name }}</a>
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

<nav id="fixNav">
	@if (Route::has('login'))
	<div class="container">
		@auth
		<ul>
			<li><a href="{{url('/')}}">Trang chủ</a></li>
			<li><a href="#">Thông tin</a></li>
			<li><a href="#">Hồ sơ</a></li>
			<li>
				<a href="#">Liên hệ</a>
			</li>
		</ul>
		@else
		@endauth
	</div>
	@endif
</nav>
<br />

<body>
	<div class="container">
		@section('content')
		@show
	</div>
</body>


</html>