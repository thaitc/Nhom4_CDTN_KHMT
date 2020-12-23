@extends('templates.master')

@section('title','Quản lý học sinh')

@section('content')

<div class="page-header">
    <h4>Quản lý học sinh</h4>
</div>

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
<form action="{{ url('/hocsinh/update') }}" method="post">
    <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
    <input type="hidden" id="id" name="id" value="{!! $getHocSinhById[0]->id !!}" />
    <div class="form-group">
        <label for="tenhocsinh">Tên học sinh</label>
        <input type="text" class="form-control" id="tenhocsinh" name="tenhocsinh" placeholder="Tên học sinh" maxlength="255" value="{{ $getHocSinhById[0]->tenhocsinh }}" required />
    </div>
    <div class="form-group">
        <label for="sodienthoai">Số điện thoại</label>
        <input type="text" class="form-control" id="sodienthoai" name="sodienthoai" placeholder="Số điện thoại" maxlength="15" value="{{ $getHocSinhById[0]->sodienthoai }}" required />
    </div>
    <div class="form-group">
        <label for="hinhthe">Chọn hình thẻ mới</label>
        <input type="file" class="form-control" id="hinhthe" name="hinhthe" />
    </div>
    <div class="form-group">
        <label for="lylich">Chọn file lý lịch mới</label>
        <input type="file" class="form-control" id="lylich" name="lylich" />
    </div>
    <div class="form-group">
        <label for="khoi">Chọn khối</label>
        <select class="form-control" id="khoi" name="khoi" required>
            <option value="">-- Chọn khối --</option>
            @foreach($dskhoi as $khoi)
            <option value="{!! $khoi->id !!}" {!! ($getHocSinhById[0]->khoi == $khoi->id) ? 'selected="selected"' : null !!}>{!! $khoi->tenkhoi !!}</option>
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