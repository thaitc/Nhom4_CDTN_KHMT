@extends('templates.admin')

@section('title','Quản lý môn học')

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
    <form action="{{ url('admin/monhoc/update') }}" method="post">
        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
        <input type="hidden" id="id" name="id" value="{!! $getMonhocById[0]->id !!}" />
        <div class="form-group">
            <label for="tenmon">Tên môn</label>
            <input type="text" class="form-control" id="tenmon" name="tenmon" placeholder="Tên môn học" maxlength="255" value="{{ $getMonhocById[0]->tenmon }}" required />
        </div>
        <div class="form-group">
            <label for="tengiangvien">Chọn khoa</label>
            <select class="form-control" id="tenkhoa" name="tenkhoa" required>
                <option value="">-- Chọn khoa --</option>
                @foreach($dskhoa as $tenkhoa)
                <option value="{!! $tenkhoa->tenkhoa !!}" {!! ($getMonhocById[0]->tenkhoa == $tenkhoa->tenkhoa) ? 'selected="selected"' : null !!}>{!! $tenkhoa->tenkhoa !!}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sodienthoai">Tín chỉ</label>
            <input type="text" class="form-control" id="tinchi" name="tinchi" placeholder="Tín chỉ" maxlength="255" value="{{ $getMonhocById[0]->tinchi }}" required />
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