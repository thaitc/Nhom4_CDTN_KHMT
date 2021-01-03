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
<form action="{{ url('/admin/admindiem/updatediem') }}" method="post">
    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
    <input type="hidden" id="id" name="id" value="{!! $getdiem[0]->id !!}" />
    <div class="form-group">
        <label for="tensinhvien">Mã sinh viên</label>
        <input type="text" class="form-control" id="masinhvien" name="masinhvien" placeholder="Mã sinh viên" maxlength="255" value="{{ $getdiem[0]->masinhvien }}" required />
    </div>
    <div class="form-group">
        <label for="email">Điểm</label>
        <input type="text" class="form-control" id="diem" name="diem" placeholder="Điểm" maxlength="15" value="{{ $getdiem[0]->diem }}" required />
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