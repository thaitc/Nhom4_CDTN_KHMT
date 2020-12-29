@extends('templates.admin')

@section('title','Thêm mới giảng viên')

@section('content')
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

<div class="col-xs-4 col-xs-offset-4">
    <center>
        <h4>Thêm giảng viên</h4>
    </center>
    <form action="{{ url('admin/giangvien/create') }}" method="post">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="tengiangvien">Tên giảng viên</label>
            <input type="text" class="form-control" id="tengiangvien" name="tengiangvien" placeholder="Tên giảng viên" maxlength="255" required />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="100" required />
        </div>
        <div class="form-group">
            <label for="pass">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" maxlength="500" required />
        </div>
        <div class="form-group">
            <label for="diachi">Địa chỉ</label>
            <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Địa chỉ" maxlength="500" required />
        </div>
        <div class="form-group">
            <label for="tengiangvien">Chọn khoa</label>
            <select class="form-control" id="tenkhoa" name="tenkhoa" required>
                <option value="">-- Chọn khoa --</option>
                @foreach($dskhoa as $tenkhoa)
                <option value="{!! $tenkhoa->tenkhoa !!}">{!! $tenkhoa->tenkhoa !!}</option>
                @endforeach
            </select>
        </div>
        
        
        <center><button type="submit" class="btn btn-primary">Thêm</button></center>
    </form>
</div>
@endsection