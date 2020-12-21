<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> @yield('title')</title>
	<link href="/Quanlytruonghoc/resources/css/login.css" rel="stylesheet" >
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		@section('content')
		@show
		@if (Auth::check())
		<div>
			Bạn đang đăng nhập với quyền
			@if( Auth::user()->level == 1)
			{{ "SuperAdmin" }}
			@elseif( Auth::user()->level == 2)
			{{ "Admin" }}
			@elseif( Auth::user()->level == 3)
			{{ "Thành viên" }}
			@endif
		</div>
		<div class="pull-right" style="margin-top: 3px;"><a class="btn btn-primary" href="{{ url('/logout') }}">Đăng xuất</a></div>
		@endif
	</div>
	<<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script type="text/javascript">
		$(document).ready(function() {
			$("#DataList").DataTable({
				"aLengthMenu": [
					[10, 25, 50, 100, -1],
					[10, 25, 50, 100, "Tất cả"]
				],
				"iDisplayLength": 10,
				"oLanguage": {
					"sLengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
					"oPaginate": {
						"sFirst": "<span class='glyphicon glyphicon-step-backward' aria-hidden='true'></span>",
						"sLast": "<span class='glyphicon glyphicon-step-forward' aria-hidden='true'></span>",
						"sNext": "<span class='glyphicon glyphicon-triangle-right' aria-hidden='true'></span>",
						"sPrevious": "<span class='glyphicon glyphicon-triangle-left' aria-hidden='true'></span>"
					},
					"sEmptyTable": "Không có dữ liệu",
					"sSearch": "Tìm kiếm:",
					"sZeroRecords": "Không có dữ liệu",
					"sInfo": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng được tìm thấy",
					"sInfoEmpty": "Không tìm thấy",
					"sInfoFiltered": " (trong tổng số _MAX_ dòng)"
				}
			});
		});
	</script>
</body>

</html>