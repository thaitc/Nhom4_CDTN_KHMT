<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class XephangController extends Controller
{
    public function index()
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('thoikhoabieu')->select('sinhvien', 'masinhvien')->distinct('masinhvien')->where('tenkhoa',  Auth::user()->tenkhoa)->orderByDesc('diem')->get();
        $diemtb = DB::table('thoikhoabieu')
            ->select(DB::raw('avg(diem) as diem'))
            ->groupBy('masinhvien')->orderByDesc('diem')
            ->get();
        return view('xephang', ['getSinhVienById' => $getData, 'dskhoa' => $dskhoa, 'diemtb' => $diemtb]);
    }
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
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
        if ($updateData) {
            Session::flash('success', 'Sửa học sinh thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect('profile');
    }
}
