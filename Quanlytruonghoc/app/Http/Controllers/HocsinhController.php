<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;

class HocsinhController extends Controller
{
    public function create()
    {
        //Hiển thị trang thêm học sinh
        return view('hocsinh.create');
    }
    public function store(Request $request)
    {
        //Them moi hoc sinh
        //Set timezone
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        //Lấy giá trị học sinh đã nhập
        $allRequest  = $request->all();
        $tenhocsinh  = $allRequest['tenhocsinh'];
        $sodienthoai = $allRequest['sodienthoai'];

        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'tenhocsinh'  => $tenhocsinh,
            'sodienthoai' => $sodienthoai,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('tbl_hocsinh')->insert($dataInsertToDatabase);

        //Kiểm tra Insert để trả về một thông báo
        // if ($insertData) {
        //     Session::flash('success', 'Thêm mới học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Thêm thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('hocsinh');
    }
    public function index()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('tbl_hocsinh')->select('id', 'tenhocsinh', 'sodienthoai')->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('hocsinh.list')->with('listhocsinh', $getData);
    }
    public function edit($id)
    {
        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('tbl_hocsinh')->select('id', 'tenhocsinh', 'sodienthoai')->where('id', $id)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData
        return view('hocsinh.edit')->with('getHocSinhById', $getData);
    }
    public function update(Request $request)
    {
        //Cap nhat sua hoc sinh
        //Set timezone
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        //Thực hiện câu lệnh update với các giá trị $request trả về
        $updateData = DB::table('tbl_hocsinh')->where('id', $request->id)->update([
            'tenhocsinh' => $request->tenhocsinh,
            'sodienthoai' => $request->sodienthoai,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        // if ($updateData) {
        //     Session::flash('success', 'Sửa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Sửa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('hocsinh');
    }
    public function destroy($id)
    {
        //Xoa hoc sinh
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        $deleteData = DB::table('tbl_hocsinh')->where('id', '=', $id)->delete();

        //Kiểm tra lệnh delete để trả về một thông báo
        // if ($deleteData) {
        //     Session::flash('success', 'Xóa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Xóa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('hocsinh');
    }
}
