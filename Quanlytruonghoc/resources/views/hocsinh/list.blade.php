@extends('templates.admin')
@section('title','Quản lý trường học')
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
            <p><a class="btn btn-primary" href="{{ url('/hocsinh/create') }}">Thêm mới</a></p>
            <table id="DataList" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên học sinh</th>
                        <th>Số điện thoại</th>
                        <th>Hình thẻ</th>
                        <th>File lý lịch</th>
                        <th>Khối</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //Vòng lập foreach lấy giá vào bảng
                    ?>
                    @foreach($listhocsinh as $key => $hocsinh)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $key+1 }}</td>
                        <td style="vertical-align: middle;"><a href="#">{{ $hocsinh->tenhocsinh }}</a></td>
                        <td style="vertical-align: middle;">{{ $hocsinh->sodienthoai }}</td>
                        <td style="text-align: center; vertical-align: middle; width: 10%;">
                            @if($hocsinh->hinhthe != '')
                            <img onclick="MymodalImage(this);" alt="{{ $hocsinh->tenhocsinh }}" src="/Quanlytruonghoc/public/upload/hinhthe/{{ $hocsinh->hinhthe }}" style="cursor: zoom-in;" width="60" />
                            @else
                            <img onclick="MymodalImage(this);" alt="{{ $hocsinh->tenhocsinh }}" src="/Quanlytruonghoc/public/upload/hinhthe/noimage.png" style="cursor: zoom-in;" width="60" />
                            @endif
                        <td style="text-align: center; vertical-align: middle; width: 10%;">
                            @if($hocsinh->lylich != '')
                            <a class="btn btn-primary" href="/Quanlytruonghoc/public/upload/lylich/{{ $hocsinh->lylich }}">Download về máy</a>
                            @else
                            <img onclick="MymodalImage(this);" src="/public/upload/lylich/nofile.png" alt="{{ $hocsinh->tenhocsinh }}" style="cursor: zoom-in;" width="60" />
                            @endif
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ $hocsinh->tenkhoi }}
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><a href="hocsinh/{{ $hocsinh->id }}/edit">Sửa</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="hocsinh/{{ $hocsinh->id }}/delete">Xóa</a></td>
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
@endsection