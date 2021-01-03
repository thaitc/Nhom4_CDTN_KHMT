@extends('welcome')
@section('title','Đánh giá giảng viên')
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
<style>
    

    .hnue_form {
        margin: 40px auto;
        border: 2px dashed #ddd;
        padding: 10px 30px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
    }
</style>
<div class="container hnue_form">
    <div class="text-center">
        <h3><b>PHIẾU LẤY Ý KIẾN PHẢN HỒI TỪ NGƯỜI HỌC ĐỐI VỚI GIẢNG VIÊN</b></h3>
    </div>
    <br />
    <div>
        Để cải thiện và nâng cao chất lương dạy và học, đề nghị các anh/chị học viên, sinh viên
        cho ý kiến về các nội dung dưới đây. Thông tin về người cho ý kiến sẽ được hoàn toàn giữ bí mật. Hãy chọn vào ô tương ứng theo các mức độ.
    </div><br />
    <label>Hãy đánh vào ô tương ứng theo các mức độ từ 1-5 như sau:</label><br />
    <div class="row">
        <div class="col-md-2">
            <b>1 = Cần cải thiện</b>
        </div>
        <div class="col-md-2">
            <b>2 = Đạt</b>
        </div>
        <div class="col-md-2">
            <b>3 = Khá</b>
        </div>
        <div class="col-md-2">
            <b>4 = Tốt</b>
        </div>
        <div class="col-md-2">
            <b>5 = Xuất sắc</b>
        </div>
    </div>
    <br />
    <form action="{{ url('/danhgia/update') }}" method="post">
        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
        <input type="hidden" id="id" name="id" value="{!! $getTKBById[0]->id !!}" />
        <div class="row">
            <div class="col-md-6">
                <label for="tengiangvien">Tên giảng viên</label>
                <input type="text" class="form-control" id="tengiangvien" name="tengiangvien" placeholder="Tên giảng viên" maxlength="255" value="{{ $getTKBById[0]->tengiangvien }}" required />
            </div>
            <div class="col-md-6">
                <label for="tengiangvien">Tên môn</label>
                <input class="form-control" id="tenmon" name="tenmon" value="{{ $getTKBById[0]->tenmon }}" required />
            </div>
            <div class="col-md-6">
                <label for="tenkhoa">Tên khoa</label>
                <select class="form-control" id="tenkhoa" name="tenkhoa" required>
                    <option value="">-- Chọn khoa --</option>
                    @foreach($dskhoa as $tenkhoa)
                    <option value="{!! $tenkhoa->tenkhoa !!}" {!! ($getTKBById[0]->tenkhoa == $tenkhoa->tenkhoa) ? 'selected="selected"' : null !!}>{!! $tenkhoa->tenkhoa !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>Ngày đánh giá</label>
                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
            </div>
        </div>
        <br />
        <table class="table table-hover">
            <thead class="table-active">
                <th>Giảng viên đã thực hiện hoạt động giảng dạy như sau</th>
                <th>Mức độ thực hiện</th>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left;">
                        <label>Giới thiệu chương trình chi tiết của học phần trước khi học</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Đến lớp và kết thúc đúng giờ</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia1" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia1" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia1" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia1" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia1" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Sử dụng hiệu quả thời gian tiết học cho việc dạy học</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia2" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia2" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia2" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia2" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia2" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td  style="text-align: left;">
                        <label>Ngôn ngữ, tác phong chuẩn mực</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia3" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia3" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia3" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia3" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia3" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Sẵn sàng tư vấn hỗ trợ sinh viên</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia4" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia4" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia4" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia4" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia4" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Nội dung giảng dạy được liên hệ với thực tiễn</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia5" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia5" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia5" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia5" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia5" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Phương pháp giảng dạy phù hợp với sinh viên</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia6" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia6" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia6" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia6" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia6" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Kiểm tra, đánh giá kết quả học tập công bằng khách quan</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia7" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia7" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia7" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia7" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia7" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Phản hồi kịp thời kết quả kiểm tra, đánh giá giúp người học điều chỉnh</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia8" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia8" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia8" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia8" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia8" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td  style="text-align: left;">
                        <label>Dạy đủ số tiết theo quy định</label>
                    </td>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia9" id="danhgia" required value="2">
                            <label class="form-check-label" for="inlineRadio1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia9" id="danhgia" required value="4">
                            <label class="form-check-label" for="inlineRadio2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia9" id="danhgia" required value="7">
                            <label class="form-check-label" for="inlineRadio3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia9" id="danhgia" required value="9">
                            <label class="form-check-label" for="inlineRadio3">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="danhgia9" id="danhgia" required value="10">
                            <label class="form-check-label" for="inlineRadio3">5</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <textarea class="form-control" rows="4" name="ykienkhac" placeholder="Ý kiến khác..."></textarea>
        <br />
        <center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
    </form>
    <br />
    <div class="text-center">
        <i>Trân trọng cảm ơn sự đóng góp ý kiến của anh/chị!</i>
    </div>
</div>
@endsection