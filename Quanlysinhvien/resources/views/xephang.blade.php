@extends('welcome')
@section('title','Quản lý giảng viên')
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
<?php //Hiển thị danh sách học sinh
?>
<div class="row">
</div>
<br />
<div class="row">
    <div style="text-align: center;" class="col-md-4">
        <label>Ma sinh viên</label><br />
        @foreach($getSinhVienById as $key => $mama)
        <a>{{ ($mama ->masinhvien)}}</a><br />
        @endforeach
    </div>
    <div style="text-align: center;" class="col-md-4">
        <label>Tên sinh viên</label><br />
        @foreach($getSinhVienById as $key => $diem)
        <a>{{ ($diem ->sinhvien)}}</a><br />
        @endforeach
    </div>
    <div class="col-md-4">
        <label>Điểm</label><br />
        @foreach($diemtb as $key => $diem1)
        <a>{{ ($diem1 ->diem)}}</a><br />
        @endforeach
    </div>
</div>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection