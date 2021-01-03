@extends('welcome')
@section('title','Đăng nhập')
@section('content')
<?php //Hiển thị thông báo thành công
?>
@if ( Session::has('success') )
<div class="alert alert-success alert-dismissible" role="alert">
	<strong>{{ Session::get('success') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span>
	</button>
</div>
@endif
<?php //Hiển thị thông báo lỗi
?>
@if ( Session::has('error') )
<div class="alert alert-danger alert-dismissible" role="alert">
	<strong>{{ Session::get('error') }}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span>
	</button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible" role="alert">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span>
	</button>
</div>
@endif
<link href="/Quanlysinhvien/resources/css/login.css" rel="stylesheet" >
<div class="wrapper fadeInDown">
	<div id="formContent">
		<!-- Tabs Titles -->

		<!-- Icon -->
		<div class="fadeIn first">
			<img src="/Quanlysinhvien/img/it.png" id="icon1" alt="User Icon" />
		</div>
		<br/>
		<!-- Login Form -->
		<form role="form" action="{{ url('/login') }}" method="POST">
			{!! csrf_field() !!}
			<input placeholder="Email" name="email" type="text" value="{{ old('email') }}" class="fadeIn second">
			<input placeholder="Mật khẩu" name="password" type="password" value="" class="fadeIn second">
			<input type="submit" class="fadeIn second" value="Đăng Nhập">
		</form>

		<!-- Remind Passowrd -->
		<!-- <div id="formFooter">
			<a href="{{ url('/register') }}" style="text-decoration: none;" class="underlineHover">Đăng ký</a>
		</div> -->

	</div>
	<br/>
</div>
<style>
	body {
		background: url('/quanlysinhvien/img/no.jpg');
	}

	.panel {
		border-radius: 5px;
	}

	.panel-heading {
		padding: 10px 15px;
	}

	

	.panel-footer {
		padding: 1px 15px;
		color: #A0A0A0;
	}

	.profile-img {
		width: 120px;
		height: 120px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
</style>
@endsection