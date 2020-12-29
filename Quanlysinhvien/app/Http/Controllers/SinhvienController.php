<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
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
        }
        else
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

        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('sinhvien')->insert($dataInsertToDatabase);
        // if ($insertData) {
        // 	Session::flash('success', 'Thêm mới học sinh thành công!');
        // }else {                        
        // 	Session::flash('error', 'Thêm thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/sinhvien');
    }
    public function index()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('sinhvien as sv')
            ->leftJoin('khoa as tenkhoa', 'sv.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('sv.id', 'sv.masinhvien', 'sv.hoten', 'sv.email', 'sv.diachi', 'tenkhoa.tenkhoa')->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('sinhvien.list')->with('listsinhvien', $getData);
    }
    public function edit($id)
    {
        //Lấy dữ liệu bảng tbl_khoi từ Database
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();

        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('sinhvien')->select('id', 'masinhvien', 'hoten', 'email', 'diachi', 'tenkhoa')->where('id', $id)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('sinhvien.edit', ['getSinhVienById' => $getData, 'dskhoa' => $dskhoa]);
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
        $updateData = DB::table('sinhvien')->where('id', $request->id)->update([
            'masinhvien' => $request->masinhvien,
            'hoten' => $request->hoten,
            'email' => $request->email,
            'diachi' => $request->diachi,
            'tenkhoa' => $request->tenkhoa,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        // if ($updateData) {
        //     Session::flash('success', 'Sửa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Sửa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/sinhvien');
    }
    public function destroy($id)
    {
        //Xoa hoc sinh
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        $deleteData = DB::table('sinhvien')->where('id', '=', $id)->delete();

        //Kiểm tra lệnh delete để trả về một thông báo
        // if ($deleteData) {
        //     Session::flash('success', 'Xóa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Xóa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/sinhvien');
    }
}
