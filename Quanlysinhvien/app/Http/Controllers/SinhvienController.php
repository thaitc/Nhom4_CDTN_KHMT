<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SinhvienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        if (!$this->userCan('super_admin')) {
            abort(403);
        } else
            $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        return view('sinhvien.create')->with('dskhoa', $dskhoa);
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'masinhvien' => 'required',
                'hoten' => 'required',
                'email' => 'required',
                'tenkhoa' => 'required',
                'diachi' => 'required',
            ],
            [
                'masinhvien.required' => 'Bạn chưa nhập mã sinh viên!',
                'hoten.required' => 'Bạn chưa nhập họ tên!',
                'email.required' => 'Bạn chưa nhập email!',
                'tenkhoa.required' => 'Bạn chưa chọn khoa!',
                'diachi.required' => 'Bạn chưa nhập địa chỉ!',
            ]
        );
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $masinhvien  = $allRequest['masinhvien'];
        $hoten = $allRequest['hoten'];
        $email = $allRequest['email'];
        $tenkhoa = $allRequest['tenkhoa'];
        $diachi = $allRequest['diachi'];

        $dataInsertToDatabase = array(
            'masinhvien'  => $masinhvien,
            'hoten' => $hoten,
            'email' => $email,
            'tenkhoa' => $tenkhoa,
            'diachi' => $diachi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $insertData = DB::table('sinhvien')->insert($dataInsertToDatabase);
        if ($insertData) {
            Session::flash('success', 'Thêm mới sinh viên thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('admin/sinhvien');
    }
    public function index()
    {
        $getData = DB::table('sinhvien as sv')
            ->leftJoin('khoa as tenkhoa', 'sv.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('sv.id', 'sv.masinhvien', 'sv.hoten', 'sv.email', 'sv.diachi', 'tenkhoa.tenkhoa')->get();
        return view('sinhvien.list')->with('listsinhvien', $getData);
    }
    public function edit($id)
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('sinhvien')->select('id', 'masinhvien', 'hoten', 'email', 'diachi', 'tenkhoa')->where('id', $id)->get();
        return view('sinhvien.edit', ['getSinhVienById' => $getData, 'dskhoa' => $dskhoa]);
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
        $updateData = DB::table('sinhvien')->where('id', $request->id)->update([
            'masinhvien' => $request->masinhvien,
            'hoten' => $request->hoten,
            'email' => $request->email,
            'diachi' => $request->diachi,
            'tenkhoa' => $request->tenkhoa,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($updateData) {
            Session::flash('success', 'Sửa sinh viên thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect('admin/sinhvien');
    }
    public function destroy($id)
    {
        $deleteData = DB::table('sinhvien')->where('id', '=', $id)->delete();
        if ($deleteData) {
            Session::flash('success', 'Xóa sinh viên thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect('admin/sinhvien');
    }
}
