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
<?php //Hiển thị danh sách gv
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <form action="{{url('danhsachlop/danhsachchitiet')}}" method="post">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sinh viên</th>
                            <th>Tên môn</th>
                            <th>Điểm</th>
                            <th colspan="2">Actinon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //Vòng lập foreach lấy giá vào bảng
                        ?>
                        @foreach($listdanhsachlop as $key => $ds)
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">{{ $key+1 }}</td>
                            <td style="vertical-align: middle;"><a href="#">{{ $ds->sinhvien }}</a></td>
                            <td style="vertical-align: middle;">{{ $ds->tenmon }}</td>
                            <td style="vertical-align: middle;">
                                <input type="number" class="form-control" value="{{$ds->diem}}" id="diem" name="diem" placeholder="Nhập điểm" maxlength="255" required />
                            </td>
                            <td style="text-align: center; vertical-align: middle;"><a href="danhsachchitiet/{{ $ds->id }}/edit">Sửa</a></td>
                            <td style="text-align: center; vertical-align: middle;"><a href="danhsachchitiet/{{ $ds->id }}">Up</a></td>
                             <!-- <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Sửa</button></td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
            </form>

        </div>
    </div>
</div>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function MymodalImage(e) {
        // Get the modal
        var modal = document.getElementById('myModal');
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = e.src;
        captionText.innerHTML = e.alt;
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                lengthMenu: "Số bản ghi trên 1 trang _MENU_ ",
                search: "Tìm kiếm",
                info: "Tổng cộng: <b>_TOTAL_</b> bản ghi",
                infoFiltered: '',
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