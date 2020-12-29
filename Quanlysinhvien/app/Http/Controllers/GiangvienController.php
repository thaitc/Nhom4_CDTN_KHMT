<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class GiangvienController extends Controller
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
        return view('giangvien.create')->with('dskhoa', $dskhoa);
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'tengiangvien' => 'required',
                'email' => 'required',
                'diachi' => 'required',
                'tenkhoa' => 'required'
            ],
            [
                'tengiangvien.required' => 'Bạn chưa nhập tên giảng viên!',
                'email.required' => 'Bạn chưa nhập email!',
                'diachi.required' => 'Bạn chưa nhập địa chỉ!',
                'tenkhoa' => 'Bạn chưa chọn khoa'
            ]
        );
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tengiangvien  = $allRequest['tengiangvien'];
        $email = $allRequest['email'];
        $diachi = $allRequest['diachi'];
        $tenkhoa = $allRequest['tenkhoa'];
        $pass = $allRequest['password'];
        $dataInsertToDatabase = array(
            'tengiangvien'  => $tengiangvien,
            'email' => $email,
            'diachi' => $diachi,
            'tenkhoa' => $tenkhoa,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $insertData = DB::table('giangvien')->insert($dataInsertToDatabase);
        if ($insertData) {
            $dataInsertToDatabase = array(
                'ma' => '',
                'name' => $tengiangvien,
                'email' => $email,
                'password' => bcrypt($pass),
                'tenkhoa' => $tenkhoa,
                'level' => '2',
                'created_at' => date('Y-m-d H:i:s'),
            );
            $insertData = DB::table('users')->insert($dataInsertToDatabase);
            Session::flash('success', 'Thêm mới giảng viên thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('admin/giangvien');
    }
    public function index()
    {
        if (!$this->userCan('super_admin')) {
            abort(403);
        }
        else
        $getData = DB::table('giangvien as gv')
            ->leftJoin('khoa as tenkhoa', 'gv.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('gv.id', 'gv.tengiangvien', 'gv.email', 'gv.diachi', 'tenkhoa.tenkhoa')->get();
        return view('giangvien.list')->with('listgiangvien', $getData);
    }
    public function edit($id)
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('giangvien')->select('id', 'tengiangvien', 'email', 'diachi', 'tenkhoa')->where('id', $id)->get();
        return view('giangvien.edit', ['getGiangvienById' => $getData, 'dskhoa' => $dskhoa]);
    }
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->validate(
            $request,
            [
                'tengiangvien' => 'required',
                'email' => 'required',
                'password' => 'required',
                'diachi' => 'required',
                'tenkhoa' => 'required'
            ],
            [
                'tengiangvien.required' => 'Bạn chưa nhập tên giảng viên!',
                'email.required' => 'Bạn chưa nhập email!',
                'password.required' => 'Bạn chưa nhập password!',
                'diachi.required' => 'Bạn chưa nhập điạ chỉ!',
                'tenkhoa.required' => 'Bạn chưa chọn khoa!'
            ]
        );
        $updateData = DB::table('giangvien')->where('id', $request->id)->update([
            'tengiangvien' => $request->tengiangvien,
            'email' => $request->email,
            'diachi' => $request->diachi,
            'tenkhoa' => $request->tenkhoa,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $id = DB::table('users')->select('id')->where('email',  $request->input('email'))->get();
        foreach ($id as $id1) {
            $id1->id;
        }
        $pass = $request->input('password');
        $updateData1 = DB::table('users')->where('id', $id1->id)->update([
            'name' => $request->tengiangvien,
            'email' => $request->email,
            'password' => bcrypt($pass),
            'tenkhoa' => $request->tenkhoa,
            'level' => '2',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($updateData && $updateData1) {
            Session::flash('success', 'Sửa giảng viên thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect('admin/giangvien');
    }
    public function destroy($id)
    {
        $deleteData = DB::table('giangvien')->where('id', '=', $id)->delete();
        if ($deleteData) {
            Session::flash('success', 'Xóa giảng viên thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect('admin/giangvien');
    }
    public function danhsachlop()
    {
        $getData = DB::table('thoikhoabieu')->select('tenmon')->distinct()->where('email', Auth::user()->email)->get();
        return view('giangvien.danhsachlop')->with('listdanhsachlop', $getData);
    }
}
