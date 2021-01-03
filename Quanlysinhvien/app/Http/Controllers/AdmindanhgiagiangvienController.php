<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdmindanhgiagiangvienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Request $request)
    {
        $dsgv = DB::table('monhoc')->join('giangvien', 'monhoc.tenkhoa', '=', 'giangvien.tenkhoa')->distinct()->select('tengiangvien')->where('giangvien.tenkhoa',  Auth::user()->tenkhoa)->get();
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->get();
        return view('thoikhoabieu.create')->with('dstenmon', $dsmon)->with('dstengiangvien', $dsgv);
    }
    public function index(Request $request)
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $diemtb = DB::table('danhgiagiangvien')->avg('diemtb');
        $getData = DB::table('danhgiagiangvien as hs')
            ->select('hs.id','hs.tengiangvien', 'hs.email', 'hs.tenmon', 'hs.tenkhoa','hs.diemtb','hs.tieuchi1','hs.tieuchi2','hs.tieuchi3'
            ,'hs.tieuchi4','hs.tieuchi5','hs.tieuchi6','hs.tieuchi7','hs.tieuchi8','hs.tieuchi9','hs.tieuchi10','hs.ykien')->get();
        return view('admindanhgiagiangvien')->with('listdanhgia', $getData)->with('dskhoa', $dskhoa)->with('diemtb', $diemtb);
    }
    public function index1(Request $request)
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $diem = $request->input('email');
        // $getData = DB::table('danhgiagiangvien')->select('sinhvien', 'masinhvien')->distinct('masinhvien')->where('tenkhoa',  Auth::user()->tenkhoa)->orderByDesc('diem')->get();
        $diemtb = DB::table('danhgiagiangvien')
            ->select(DB::raw('avg(diemtb) as diemtb'))->where('tenkhoa',  $request->input('tenkhoa'))
            ->groupBy('email')->orderByDesc('diemtb')
            ->get();
        $getData = DB::table('danhgiagiangvien as hs')
            ->select('hs.id','hs.tengiangvien', 'hs.email', 'hs.tenmon', 'hs.tenkhoa','hs.diemtb','hs.tieuchi1','hs.tieuchi2','hs.tieuchi3'
            ,'hs.tieuchi4','hs.tieuchi5','hs.tieuchi6','hs.tieuchi7','hs.tieuchi8','hs.tieuchi9','hs.tieuchi10','hs.ykien')->where('tenkhoa',  $request->input('tenkhoa'))->get();
        return view('admindanhgiagiangvienchitiet')->with('listdanhgia', $getData)->with('dskhoa', $dskhoa)->with('diemtb', $diemtb);
    }
    public function edit($id)
    {
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->get();
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('danhgiagiangvien')->select('id','tengiangvien')->where('id', $id)->get();
        return view('admindanhgiagiangvien', ['getdiem' => $getData, 'dskhoa' => $dskhoa,'dstenmon'=> $dsmon]);
    }
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->validate(
            $request,
            [
                'tenmon' => 'required',
                'tinchi' => 'required',
            ],
            [
                'tenmon.required' => 'Bạn chưa nhập tên môn!',
                'tinchi.required' => 'Bạn chưa chọn tín chỉ!',
            ]
        );
        $updateData = DB::table('thoikhoabieu')->where('id', $request->id)->update([
            'tenmon' => $request->tenmon,
            'tinchi' => $request->tinchi,
            'diem' => null,
        ]);
        if ($updateData) {
            Session::flash('success', 'Cập nhật thành công!');
        } else {
            Session::flash('error', 'Cập nhật thất bại!');
        }
        return redirect('admin/admindiem');
    }
    public function updatediem(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->validate(
            $request,
            [
                'masinhvien' => 'required',
                'diem' => 'required',
            ],
            [
                'masinhvien.required' => 'Bạn chưa nhập tên môn!',
                'diem.required' => 'Bạn chưa chọn điểm!',
            ]
        );
        $updateData = DB::table('thoikhoabieu')->where('id', $request->id)->update([
            'masinhvien' => $request->masinhvien,
            'diem' => $request->diem,
        ]);
        if ($updateData) {
            Session::flash('success', 'Cập nhật thành công!');
        } else {
            Session::flash('error', 'Cập nhật thất bại!');
        }
        return redirect('admin/admindiem');
    }
    

    public function destroy($id)
    {
        $deleteData = DB::table('thoikhoabieu')->where('id', '=', $id)->delete();
        if ($deleteData) {
            Session::flash('success', 'Xóa môn thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect('thoikhoabieu');
    }
}
