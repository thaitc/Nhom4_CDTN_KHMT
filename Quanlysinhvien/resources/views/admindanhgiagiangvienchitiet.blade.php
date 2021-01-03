@extends('templates.admin')
@section('title','Danh sách sinh viên')
@section('content')
@if ( Session::has('success') )
<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>
</style>
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
        <!-- <select class="form-control" id="tenkhoa" name="tenkhoa" required>
            <option value="0">-- Chọn khoa --</option>
            @foreach($dskhoa as $tenkhoa)
            <option value="{!! $tenkhoa->tenkhoa !!}">{!! $tenkhoa->tenkhoa !!}</option>
            @endforeach
        </select> -->
        <input name="tenkhoa" id="tenkhoa" value="{!! $tenkhoa->tenkhoa !!}"/>
    </div>
    <div class="col-md-6">
        <a class="btn btn-primary" href="{{ url('admin/danhgiagiangvienchitiet') }}">Lọc</a>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên giảng viên</th>
                        <th>Email</th>
                        <th>Tên môn</th>
                        <th>Tên khoa</th>
                        <th>Điểm các tiêu chí</th>
                        <th>Điểm TB</th>
                        <th>Ý kiến khác</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listdanhgia as $key => $danhgia)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $key+1 }}</td>
                        <td style="vertical-align: middle;"><a href="#">{{ $danhgia->tengiangvien }}</a></td>
                        <td style="vertical-align: middle;">{{ $danhgia->email }}</td>
                        <td style="vertical-align: middle;">{{ $danhgia->tenmon }}</td>
                        <td style="vertical-align: middle;">{{ $danhgia->tenkhoa }}</td>
                        <td>

                        </td>
                        <td style="vertical-align: middle;">{{ $danhgia->diemtb }}</td>
                        <td style="text-align: center; vertical-align: middle;"><textarea class="form-control">{{ $danhgia->ykien }}</textarea></td>
                        <td style="text-align: center; vertical-align: middle;"><a data-toggle="modal" data-target="#myModal" href="danhgiagiangvien/{{ $danhgia->id }}/edit">Sửa</a></td>
                        <!--<td style="text-align: center; vertical-align: middle;"><a href="danhgiagiangvien/{{ $danhgia->id }}/delete">Xóa</a></td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@foreach($diemtb as $key => $diemtb)
$diemtb->diemtb
@endforeach
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