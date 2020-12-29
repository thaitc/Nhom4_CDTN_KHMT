@extends('templates.admin')

@section('title','Thêm mới môn học')

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
<div class="col-xs-4 col-xs-offset-4">
    <center>
        <h4>Thêm môn học</h4>
    </center>
    <form action="{{ url('admin/monhoc/create') }}" method="post">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="tenmon">Tên môn</label>
            <input type="text" class="form-control" id="tenmon" name="tenmon" placeholder="Tên môn" maxlength="255" required />
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
        <div class="form-group">
            <label for="tinchi">Tín chỉ</label>
            <input type="text" class="form-control" id="tinchi" name="tinchi" placeholder="Tín chỉ" maxlength="10" required />
        </div>
        <center><button type="submit" class="btn btn-primary">Thêm</button></center>
    </form>
</div>
@endsection