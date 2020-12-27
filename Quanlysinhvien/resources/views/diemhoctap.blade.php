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
    <div class="col-md-6">
        Điểm TB chung: {{$diemtb}} |
        Xếp loại:
        <?php if ((float)($diemtb) < 6.5) { ?> Trung bình <?php } ?>
        <?php if ((float)($diemtb) >= 8) { ?> Giỏi <?php } ?>
        <?php if ((float)($diemtb) < 8 && (float)($diemtb) >= 6.5) { ?> Khá <?php } ?>
    </div>

</div>
<br />
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên môn</th>
                        <th>Điểm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //Vòng lập foreach lấy giá vào bảng
                    ?>
                    @foreach($getSinhVienById as $key => $diem)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $key+1 }}</td>
                        <td style="vertical-align: middle;"><a href="#">{{ $diem->tenmon }}</a></td>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ $diem->diem }}
                        </td>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection