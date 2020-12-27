@extends('templates.admin')
@section('title','Quản lý sinh viên')
@section('content')
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

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <p><a class="btn btn-primary" href="{{ url('admin/sinhvien/create') }}">Thêm mới</a></p>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Khoa</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //Vòng lập foreach lấy giá vào bảng
                    ?>
                    @foreach($listsinhvien as $key => $sinhvien)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $key+1 }}</td>
                        <td style="vertical-align: middle;"><a href="#">{{ $sinhvien->masinhvien }}</a></td>
                        <td style="vertical-align: middle;">{{ $sinhvien->hoten }}</td>
                        <td style="vertical-align: middle;">{{ $sinhvien->email }}</td>
                        <td style="vertical-align: middle;">{{ $sinhvien->diachi }}</td>
                        
                        <td style="text-align: center; vertical-align: middle;">
                            {{ $sinhvien->tenkhoa }}
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><a href="sinhvien/{{ $sinhvien->id }}/edit">Sửa</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="sinhvien/{{ $sinhvien->id }}/delete">Xóa</a></td>
                    </tr>
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