@extends('welcome')
@section('title','Điểm học tập')
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
<div class="row">
    <div class="col-md-6">
        Điểm TB chung: {{$diemtb}} |
        Xếp loại:
        <?php if ((float)($diemtb) == null) { ?> Null <?php } ?>
        <?php if ((float)($diemtb) < 5 && (float)($diemtb) >0) { ?> Yếu <?php } ?>
        <?php if ((float)($diemtb) < 6.5 && (float)($diemtb) >=5) { ?> Trung bình <?php } ?>
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
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            language: {
                lengthMenu: "Số bản ghi trên 1 trang _MENU_ ",
                search: "Tìm kiếm",
                info: "Tổng cộng: <b>_TOTAL_</b> bản ghi",
                infoFiltered:'',
                zeroRecords: "Không tìm thấy bản ghi nào",
                infoEmpty: "Không có dữ liệu ",
                paginate: {
                    first: "Trang đầu",
                    previous: "Trang trước",
                    next: "Trang sau",
                    last: "Trang cuối"
                },
            }

        });
    });
</script>
@endsection