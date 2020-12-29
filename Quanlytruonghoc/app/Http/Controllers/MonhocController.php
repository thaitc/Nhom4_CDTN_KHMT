<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;

class MonhocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        // if (!$this->userCan('super_admin')) {
        //     abort(403);
        // }
        // else
        //Lấy danh sách bảng giangvien
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        //Hiển thị trang thêm mon hoc
        return view('monhoc.create')->with('dskhoa', $dskhoa);
    }
    public function store(Request $request)
    {
        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
        $this->validate(
            $request,
            [
                //Kiểm tra giá trị rỗng
                'tenmon' => 'required',
                'tenkhoa' => 'required',
                'tinchi' => 'required',
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'tenmon.required' => 'Bạn chưa nhập tên môn!',
                'tenkhoa.required' => 'Bạn chưa chọn khoa!',
                'tinchi.required' => 'Bạn chưa nhập số tín chỉ!',
            ]
        );


        //Lấy giá trị học sinh đã nhập
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tenmon  = $allRequest['tenmon'];
        $tenkhoa = $allRequest['tenkhoa'];
        $tinchi = $allRequest['tinchi'];

        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'tenmon'  => $tenmon,
            'tenkhoa' => $tenkhoa,
            'tinchi' => $tinchi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('monhoc')->insert($dataInsertToDatabase);
        // if ($insertData) {
        // 	Session::flash('success', 'Thêm mới học sinh thành công!');
        // }else {                        
        // 	Session::flash('error', 'Thêm thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/monhoc');
    }
    public function index()
    {
        //Lấy danh sách học sinh từ database
        // $getData = DB::table('monhoc as mh')
        //     ->leftJoin('giangvien as tengiangvien', 'mh.tengiangvien', '=', 'tengiangvien.id')
        //     ->select('mh.id', 'mh.tenmon', 'mh.tengiangvien', 'mh.tinchi', 'tengiangvien.tengiangvien')->get();
        $getData = DB::table('monhoc as mh')
            ->leftJoin('khoa as tenkhoa', 'mh.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('mh.id', 'mh.tenmon', 'mh.tenkhoa', 'mh.tinchi', 'tenkhoa.tenkhoa')->get();
        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('monhoc.list')->with('listmonhoc', $getData);
    }
    public function edit($id)
    {
        //Lấy dữ liệu bảng tbl_khoi từ Database
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();

        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('monhoc')->select('id', 'tenmon', 'tenkhoa', 'tinchi')->where('id', $id)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('monhoc.edit', ['getMonhocById' => $getData, 'dskhoa' => $dskhoa]);
    }
    public function update(Request $request)
    {
        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
        $this->validate(
            $request,
            [
                'tenmon' => 'required',
                'tenkhoa' => 'required',
                'tinchi' => 'required',
            ],
            [
                'tenmon.required' => 'Bạn chưa nhập tên môn!',
                'tenkhoa.required' => 'Bạn chưa chọn khoa!',
                'tinchi.required' => 'Bạn chưa nhập tín chỉ!',
            ]
        );
        //Thực hiện câu lệnh update với các giá trị $request trả về
        $updateData = DB::table('monhoc')->where('id', $request->id)->update([
            'tenmon' => $request->tenmon,
            'tenkhoa' => $request->tenkhoa,
            'tinchi' => $request->tinchi,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        // if ($updateData) {
        //     Session::flash('success', 'Sửa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Sửa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/monhoc');
    }
    public function destroy($id)
    {
        //Xoa hoc sinh
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        $deleteData = DB::table('monhoc')->where('id', '=', $id)->delete();

        //Kiểm tra lệnh delete để trả về một thông báo
        // if ($deleteData) {
        //     Session::flash('success', 'Xóa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Xóa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/monhoc');
    }
}
