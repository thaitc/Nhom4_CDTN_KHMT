@extends('templates.admin')
@section('title','Danh sách môn học')
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
            <p><a class="btn btn-primary" href="{{ url('admin/monhoc/create') }}">Thêm mới</a></p>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên môn</th>
                        <th>Tên khoa</th>
                        <th>Tín chỉ</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listmonhoc as $key => $monhoc)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $key+1 }}</td>
                        <td style="vertical-align: middle;"><a href="#">{{ $monhoc->tenmon }}</a></td>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ $monhoc->tenkhoa }}
                        </td>
                        <td style="vertical-align: middle;">{{ $monhoc->tinchi }}</td>


                        <td style="text-align: center; vertical-align: middle;"><a href="monhoc/{{ $monhoc->id }}/edit">Sửa</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="monhoc/{{ $monhoc->id }}/delete">Xóa</a></td>
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