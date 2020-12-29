<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DanhsachlopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $tenmon)
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('thoikhoabieu as gv')
            ->select('gv.id', 'gv.masinhvien', 'gv.sinhvien', 'gv.tenmon', 'gv.tengiangvien', 'gv.email', 'gv.tinchi', 'gv.diem')->where('gv.email', Auth::user()->email)->where('gv.tenmon', $tenmon)->get();
        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('giangvien.danhsachchitiet')->with('listdanhsachlop', $getData);
    }

    public function edit($tenmon, $masinhvien)
    {
        //Lấy dữ liệu bảng tbl_khoi từ Database
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();

        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('thoikhoabieu')->select('id', 'tenmon', 'sinhvien', 'diem')->where('masinhvien', $masinhvien)->where('tenmon', $tenmon)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('giangvien.edit_diem', ['getTKBById' => $getData, 'dskhoa' => $dskhoa]);
    }
    public function update(Request $request)
    {
        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $updateData = DB::table('thoikhoabieu')->where('id', $request->id)->update([
            'diem' => $request->diem,
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Cập nhật điểm thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        //Thực hiện chuyển trang
        return redirect('danhsachlop');
    }
    public function update1(Request $request)
    {
        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $updateData = DB::table('thoikhoabieu')->update([
            'diem' => $request->diem,
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Cập nhật điểm thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        //Thực hiện chuyển trang
        return redirect('danhsachlop/danhsachchitiet');
    }
    public function danhsachlop()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('thoikhoabieu')->select('tenmon')->distinct()->where('tengiangvien', Auth::user()->name)->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('giangvien.danhsachlop')->with('listdanhsachlop', $getData);
    }
    public function danhsachchitiet($tenmon)
    {
        $getMon = DB::table('thoikhoabieu')->select('tenmon')->distinct()->where('tengiangvien', Auth::user()->name)->get();
        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('thoikhoabieu as gv')->select('gv.id', 'gv.sinhvien', 'gv.tenmon', 'gv.tinchi', 'gv.diem')->where('tengiangvien', Auth::user()->name)->where('tenmon', $tenmon)->get();
        $getData1 = DB::table('thoikhoabieu')->select('id', 'diem')->where('tenmon', $tenmon)->where('sinhvien', 'Đức')->get();
        $insert = [
            'diem' => $tenmon->diem

        ];

        DB::table('thoikhoabieu')->insert($insert);

        return view('giangvien.danhsachchitiet', ['dslop' => $getData, 'getmon' => $getMon, 'getten' => $getData1]);
    }
    public function updatediem(Request $request)
    {
        $updateData = DB::table('thoikhoabieu')->where('id', $request->id)->update([
            'diem' => $request->diem,
        ]);
        if ($updateData) {
            Session::flash('success', 'Sửa thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }

        //Thực hiện chuyển trang
        return redirect('thoikhoabieu');
    }
}
