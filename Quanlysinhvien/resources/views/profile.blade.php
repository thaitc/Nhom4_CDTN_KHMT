@extends('welcome')
@section('title','Thông tin cá nhân')
@section('content')

@if (Route::has('login'))
@auth
@if ( Session::has('success') )
<div class="alert alert-success alert-dismissible" role="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
@endif
@if ( Session::has('error') )
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
@endif
<form action="{{ url('/profile') }}" method="post">
    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
    <input type="hidden" id="id" name="id" value="{!! $getSinhVienById[0]->id !!}" />
    <div class="form-group">
        <label for="masinhvien">Mã sinh viên</label>
        <input type="text" class="form-control" id="masinhvien" name="masinhvien" placeholder="Mã học sinh" maxlength="255" value="{{ $getSinhVienById[0]->masinhvien }}" required />
    </div>
    <div class="form-group">
        <label for="tensinhvien">Tên sinh viên</label>
        <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên sinh viên" maxlength="255" value="{{ $getSinhVienById[0]->hoten }}" required />
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="200" value="{{ $getSinhVienById[0]->email }}" required />
    </div>
    <div class="form-group">
        <label for="email">Địa chỉ</label>
        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Địa chỉ" maxlength="200" value="{{ $getSinhVienById[0]->diachi }}" required />
    </div>
    <div class="form-group">
        <label for="khoi">Chọn khoa</label>
        <select class="form-control" id="tenkhoa" name="tenkhoa" required>
            <option value="">-- Chọn khoa --</option>
            @foreach($dskhoa as $tenkhoa)
            <option value="{!! $tenkhoa->tenkhoa !!}" {!! ($getSinhVienById[0]->tenkhoa == $tenkhoa->tenkhoa) ? 'selected="selected"' : null !!}>{!! $tenkhoa->tenkhoa !!}</option>
            @endforeach
        </select>
    </div>
    <center><button type="submit" class="btn btn-success">Sửa</button></center>
</form>
@if (Route::has('register'))
<a href="{{ route('register') }}">Register</a>
@endif
@endauth
@endif
@endsection