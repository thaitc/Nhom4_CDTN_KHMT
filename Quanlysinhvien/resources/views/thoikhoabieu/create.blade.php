@extends('welcome')

@section('title','Đăng ký môn học')

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
<form action="{{ url('thoikhoabieu/create') }}" method="post">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
    <div class="form-group">
        <label for="tenmon">Chọn môn</label>
        <select class="form-control" id="tenmon" name="tenmon" required>
            <option value="">-- Chọn môn --</option>
            @foreach($dstenmon as $tenmon)
            <option id="tenmon" value="{!! $tenmon->tenmon !!}">{!! $tenmon->tenmon !!}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="tengiangvien">Chọn giảng viên</label>
        <select class="form-control" id="tengiangvien" name="tengiangvien" required>
            <option value="">-- Chọn giảng viên --</option>
            @foreach($dstengiangvien as $tengiangvien)
            <option value="{!! $tengiangvien->tengiangvien !!}">{!! $tengiangvien->tengiangvien !!}</option>
            @endforeach
        </select>
    </div>
    <center><button type="submit" class="btn btn-primary">Thêm</button></center>
</form>
</div>
@endsection