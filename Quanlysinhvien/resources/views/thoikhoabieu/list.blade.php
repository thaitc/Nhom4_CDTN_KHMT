@extends('welcome')
@section('title','Quản lý thời khóa biểu')
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
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <p><a class="btn btn-primary" href="{{ url('thoikhoabieu/create') }}">Thêm mới</a></p>
            <table id="DataList" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Môn học</th>
                        <th>Giảng viên</th>
                        <th>Tín chỉ</th>
                        <th>Học phí</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listthoikhoabieu as $key => $thoikhoabieu)
                    <tr>
                        <td style="text-align: center;">{{ $key+1 }}</td>
                        <td style="vertical-align: middle;"><a href="#">{{ $thoikhoabieu->tenmon }}</a></td>
                        <td style="vertical-align: middle;">{{ $thoikhoabieu->tengiangvien }}</td>
                        <td style="vertical-align: middle;">{{ $thoikhoabieu->tinchi }}</td>                      
                        <td style="vertical-align: middle;"><a>{{ (int)($thoikhoabieu->tinchi)*300000 }}đ</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="thoikhoabieu/{{ $thoikhoabieu->id }}/edit">Sửa</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="thoikhoabieu/{{ $thoikhoabieu->id }}/delete">Hủy</a></td>
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