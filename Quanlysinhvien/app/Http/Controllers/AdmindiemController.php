<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdmindiemController extends Controller
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
        $dsgv = DB::table('monhoc')->join('giangvien', 'monhoc.tenkhoa', '=', 'giangvien.tenkhoa')->distinct()->select('tengiangvien')->where('giangvien.tenkhoa',  Auth::user()->tenkhoa)->get();
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->get();
        return view('thoikhoabieu.create')->with('dstenmon', $dsmon)->with('dstengiangvien', $dsgv);
    }
    public function index()
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('thoikhoabieu as hs')
            ->leftJoin('monhoc as tenmon', 'hs.tenmon', '=', 'tenmon.tenmon')
            ->leftJoin('giangvien as tengiangvien', 'hs.tengiangvien', '=', 'tengiangvien.tengiangvien')
            ->select('hs.id','hs.masinhvien', 'hs.sinhvien', 'tenmon.tenmon', 'tengiangvien.tengiangvien','hs.diem', 'hs.tinchi')->get();
        return view('admindiem')->with('listthoikhoabieu', $getData)->with('dskhoa', $dskhoa);
    }
    public function edit($id)
    {
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->get();
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('thoikhoabieu')->select('id','masinhvien','sinhvien','tenmon','tinchi', 'tengiangvien', 'email','diem', 'tenkhoa')->where('id', $id)->get();
        return view('admineditdiem', ['getdiem' => $getData, 'dskhoa' => $dskhoa,'dstenmon'=> $dsmon]);
    }
    public function editdiem($id)
    {
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->get();
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('thoikhoabieu')->select('id','masinhvien','sinhvien','tenmon','tinchi', 'tengiangvien', 'email','diem', 'tenkhoa')->where('id', $id)->get();
        return view('adminedit', ['getdiem' => $getData, 'dskhoa' => $dskhoa,'dstenmon'=> $dsmon]);
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
