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
        // if (!$this->userCan('super_admin')) {
        //     abort(403);
        // }
        // else
        //Lấy danh sách bảng khối
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        //Hiển thị trang thêm học sinh
        return view('giangvien.create')->with('dskhoa', $dskhoa);
    }
    public function store(Request $request)
    {
        //Kiểm tra giá trị 
        $this->validate(
            $request,
            [
                //Kiểm tra giá trị rỗng
                'tengiangvien' => 'required',
                'email' => 'required',
                'diachi' => 'required',
                'tenkhoa' => 'required'
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'tengiangvien.required' => 'Bạn chưa nhập tên giảng viên!',
                'email.required' => 'Bạn chưa nhập email!',
                'diachi.required' => 'Bạn chưa nhập địa chỉ!',
                'tenkhoa' => 'Bạn chưa chọn khoa'
            ]
        );



        //Lấy giá trị học sinh đã nhập
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tengiangvien  = $allRequest['tengiangvien'];
        $email = $allRequest['email'];
        $diachi = $allRequest['diachi'];
        $tenkhoa = $allRequest['tenkhoa'];
        $pass = $allRequest['password'];

        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'tengiangvien'  => $tengiangvien,
            'email' => $email,
            'diachi' => $diachi,
            'tenkhoa' => $tenkhoa,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('giangvien')->insert($dataInsertToDatabase);
        if ($insertData) {
            $dataInsertToDatabase = array(
                'ma'=> '',
                'name' => $tengiangvien,
                'email' => $email,
                'password' => bcrypt($pass),
                'tenkhoa' => $tenkhoa,
                'level' => '2',
                'created_at' => date('Y-m-d H:i:s'),
            );

            //Insert vào bảng tbl_hocsinh
            $insertData = DB::table('users')->insert($dataInsertToDatabase);
            Session::flash('success', 'Thêm mới giảng viên thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        //Thực hiện chuyển trang
        return redirect('admin/giangvien');
    }
    public function index()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('giangvien as gv')
            ->leftJoin('khoa as tenkhoa', 'gv.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('gv.id', 'gv.tengiangvien', 'gv.email', 'gv.diachi', 'tenkhoa.tenkhoa')->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('giangvien.list')->with('listgiangvien', $getData);
    }

    public function edit($id)
    {
        //Lấy dữ liệu bảng tbl_khoi từ Database
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();

        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('giangvien')->select('id', 'tengiangvien', 'email', 'diachi', 'tenkhoa')->where('id', $id)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('giangvien.edit', ['getGiangvienById' => $getData, 'dskhoa' => $dskhoa]);
    }
    public function update(Request $request)
    {
        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
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
        //Thực hiện câu lệnh update với các giá trị $request trả về
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

        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData && $updateData1) {
            Session::flash('success', 'Sửa giảng viên thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }

        //Thực hiện chuyển trang
        return redirect('admin/giangvien');
    }
    public function destroy($id)
    {
        //Xoa hoc sinh
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        $deleteData = DB::table('giangvien')->where('id', '=', $id)->delete();

        //Kiểm tra lệnh delete để trả về một thông báo
        // if ($deleteData) {
        //     Session::flash('success', 'Xóa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Xóa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('admin/giangvien');
    }
    public function danhsachlop()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('thoikhoabieu')->select('tenmon')->distinct()->where('email', Auth::user()->email)->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('giangvien.danhsachlop')->with('listdanhsachlop', $getData);
    }
    public function danhsachchitiet($tenmon)
    {
        $getMon = DB::table('thoikhoabieu')->select('tenmon')->distinct()->where('email', Auth::user()->email)->get();
        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('thoikhoabieu as gv')->select('gv.id', 'gv.sinhvien', 'gv.tenmon', 'gv.tinchi')->where('email', Auth::user()->email)->where('tenmon', $tenmon)->get();
        //$getData = DB::table('giangvien')->select('id', 'tengiangvien', 'email', 'diachi', 'tenkhoa')->where('tenmon', $tenmon)->get();
       
        $cars=array("Volvo","BMW","Toyota");
        var_dump( $cars );
        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('giangvien.danhsachchitiet', ['dslop' => $getData,'getmon'=>$getMon]);
    }
    public function updatediem(Request $request)
    {
        // foreach ($postals as $postal){
        //     $address = $geocoder->getCoordinatesForAddress($postal->postal_code);
        //     DB::table('schools')
        //             ->where('postal', $postal->postal_code)
        //             ->update(['lat' => $address['lat'], 'lng' => $address['lng']]);
        // }

        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $diem = $request['diem'];
        $diemm = array([
            'diem' => $diem,
        ]);
        var_dump($diemm);
        $updateData = DB::table('thoikhoabieu')->select('sinhvien');
        //Kiểm tra lệnh update để trả về một thông báo
        if ($updateData) {
            Session::flash('success', 'Cập nhật thành công!');
        } else {
            Session::flash('error', 'Cập nhật thất bại!');
        }
        $getMon = DB::table('thoikhoabieu')->select('tenmon')->distinct()->where('email', Auth::user()->email)->get();
        //Thực hiện chuyển trang
        return redirect('giangvien.danhsachchitiet', ['getmon'=>$getMon]);
    }
}
