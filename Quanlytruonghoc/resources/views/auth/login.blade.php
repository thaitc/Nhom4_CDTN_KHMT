@extends('templates.master')
@section('title','Trang quản lý')
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
<div class="wrapper fadeInDown">
	<div id="formContent">
		<!-- Tabs Titles -->

		<!-- Icon -->
		<div class="fadeIn first">
			<img src="/Quanlytruonghoc/logo.png" id="icon" alt="User Icon" />
		</div>

		<!-- Login Form -->
		<form role="form" action="{{ url('/login') }}" method="POST">
			{!! csrf_field() !!}
			<input placeholder="Email" name="email" type="text" value="{{ old('email') }}" class="fadeIn second">
			<input placeholder="Mật khẩu" name="password" type="password" value="" class="fadeIn second">
			<input type="submit" class="fadeIn fourth" value="Đăng Nhập">
		</form>

		<!-- Remind Passowrd -->
		<div id="formFooter">
			<a href="{{ url('/register') }}" style="text-decoration: none;" class="underlineHover">Đăng ký</a>
		</div>

	</div>
</div>
<style>
	body {
		background: #17568C;
	}

	.panel {
		border-radius: 5px;
	}

	.panel-heading {
		padding: 10px 15px;
	}

	.panel-title {
		text-align: center;
		font-size: 15px;
		font-weight: bold;
		color: #17568C;
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