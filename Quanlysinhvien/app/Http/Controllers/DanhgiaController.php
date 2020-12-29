<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class DanhgiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mon(Request $request)
    {
        return $request->get('tenmon');
    }
    public function create(Request $request)
    {
        $names = $request->input('tenmon');;
        //Lấy danh sách bảng khối
        $dsgv = DB::table('monhoc')->join('giangvien', 'monhoc.tenkhoa', '=', 'giangvien.tenkhoa')->distinct()->select('tengiangvien')->where('giangvien.tenkhoa',  Auth::user()->tenkhoa)->get();
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->where('tenkhoa',  Auth::user()->tenkhoa)->get();
        //Hiển thị trang thêm học sinh
        return view('thoikhoabieu.create')->with('dstenmon', $dsmon)->with('dstengiangvien', $dsgv);
    }
    public function store(Request $request)
    {
        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
        $this->validate(
            $request,
            [
                //Kiểm tra giá trị rỗng

                'tenmon' => 'required',
                'tengiangvien' => 'required',
            ],
            [
                //Tùy chỉnh hiển thị thông báo

                'tenmon.required' => 'Bạn chưa chon mon!',
                'tengiangvien.required' => 'Bạn chưa chọn giang vien!',
            ]
        );

        //Lấy giá trị học sinh đã nhập
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tenmon = $allRequest['tenmon'];
        $tengiangvien = $allRequest['tengiangvien'];
        $email = DB::table('giangvien')->select('email')->where('tengiangvien',  $request->input('tengiangvien'))->get();
        foreach ($email as $gv) {
            $gv->email;
        }
        $tinchi = DB::table('monhoc')->select('tinchi')->where('tenmon',  $request->input('tenmon'))->get();
        foreach ($tinchi as $tin) {
            $tin->tinchi;
        }
        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'masinhvien' =>Auth::user()->ma,
            'sinhvien'  => Auth::user()->name,
            'tenmon' => $tenmon,
            'tengiangvien' => $tengiangvien,
            'email' => $gv->email,
            'tinchi' => $tin->tinchi,
        );

        //Insert vào bảng tbl_hocsinh
        $insertData = DB::table('thoikhoabieu')->insert($dataInsertToDatabase);
        if ($insertData) {
            Session::flash('success', 'Thêm  thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        //Thực hiện chuyển trang
        return redirect('/thoikhoabieu');
    }
    public function index()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('thoikhoabieu as hs')
            ->leftJoin('monhoc as tenmon', 'hs.tenmon', '=', 'tenmon.tenmon')
            ->leftJoin('giangvien as tengiangvien', 'hs.tengiangvien', '=', 'tengiangvien.tengiangvien')
            ->select('hs.id', 'hs.sinhvien', 'tenmon.tenmon', 'tengiangvien.tengiangvien', 'hs.tinchi')->where('hs.masinhvien', Auth::user()->ma)->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('sinhvien.danhgia')->with('listthoikhoabieu', $getData);
    }
}
