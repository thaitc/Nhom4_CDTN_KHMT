@extends('templates.admin')

@section('title','Sửa')

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
<form action="{{ url('/admin/admindiem/update') }}" method="post">
    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
    <input type="hidden" id="id" name="id" value="{!! $getdiem[0]->id !!}" />
    <div class="form-group">
        <label for="tensinhvien">Tên sinh viên</label>
        <input type="text" class="form-control" id="sinhvien" name="sinhvien" placeholder="Tên sinh viên" maxlength="255" value="{{ $getdiem[0]->sinhvien }}" required />
    </div>
    <div class="form-group">
        <label for="email">Tín chỉ</label>
        <input type="text" class="form-control" id="tinchi" name="tinchi" placeholder="Tín chỉ" maxlength="15" value="{{ $getdiem[0]->tinchi }}" required />
    </div>
    <div class="form-group">
    <label for="email">Tên môn</label>
        <select class="form-control" id="tenmon" name="tenmon" required>
            <option value="">-- Chọn môn --</option>
            @foreach($dstenmon as $tenmon)
            <option value="{!! $tenmon->tenmon !!}" {!! ($getdiem[0]->tenmon == $tenmon->tenmon) ? 'selected="selected"' : null !!}>{!! $tenmon->tenmon !!}</option>
            @endforeach
        </select>
    </div>
    <center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
</form>
</div>
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
@endsection