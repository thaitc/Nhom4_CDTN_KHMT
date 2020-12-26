<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('sinhvien')->select('id', 'masinhvien', 'hoten', 'email', 'diachi', 'tenkhoa')->where('email',  Auth::user()->email)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('profile', ['getSinhVienById' => $getData, 'dskhoa' => $dskhoa]);
    }
    public function update(Request $request)
    {
        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
        $this->validate(
            $request,
            [
                'masinhvien' => 'required',
                'hoten' => 'required',
                'email' => 'required',
                'diachi' => 'required',
                'tenkhoa' => 'required',
            ],
            [
                'masinhvien.required' => 'Bạn chưa nhập mã sinh viên!',
                'hoten.required' => 'Bạn chưa nhập họ tên!',
                'email.required' => 'Bạn chưa nhập email!',
                'diachi.required' => 'Bạn chưa nhập địa chỉ!',
                'tenkhoa.required' => 'Bạn chưa chọn khoa!',
            ]
        );


        //Thực hiện câu lệnh update với các giá trị $request trả về
        $masinhvien = $request['masinhvien'];
        $hoten = $request['hoten'];
        $diachi = $request['diachi'];
        $tenkhoa = $request['tenkhoa'];
        $updateData = DB::table('sinhvien')->where('email', Auth::user()->email)->update([
            'masinhvien' => $masinhvien,
            'hoten' => $hoten,
            'diachi' => $diachi,
            'tenkhoa' => $tenkhoa,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $tenkhoa = $request['tenkhoa'];
        $updateData = DB::table('users')->where('email', Auth::user()->email)->update([
            'tenkhoa' => $tenkhoa,
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Sửa học sinh thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }

        //Thực hiện chuyển trang
        return redirect('profile');
    }
}
