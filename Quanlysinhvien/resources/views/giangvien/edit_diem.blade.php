@extends('welcome')

@section('title','Cập nhật điểm')

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
<form action="{{ url('danhsachlop/update') }}" method="post">
    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
    <input type="hidden" id="id" name="id" value="{!! $getTKBById[0]->id !!}" />
    <div class="form-group">
        <label for="diem">Nhập điểm cho {{$getTKBById[0]->sinhvien}}</label>
        <input type="text" class="form-control" id="diem" name="diem" placeholder="Nhập điểm" maxlength="255" value="{{ $getTKBById[0]->diem }}" required />
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