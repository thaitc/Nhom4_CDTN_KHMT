<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class MonhocController extends Controller
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
        return view('monhoc.create')->with('dskhoa', $dskhoa);
    }
    public function store(Request $request)
    {
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
                'tinchi.required' => 'Bạn chưa nhập số tín chỉ!',
            ]
        );
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tenmon  = $allRequest['tenmon'];
        $tenkhoa = $allRequest['tenkhoa'];
        $tinchi = $allRequest['tinchi'];
        $dataInsertToDatabase = array(
            'tenmon'  => $tenmon,
            'tenkhoa' => $tenkhoa,
            'tinchi' => $tinchi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $insertData = DB::table('monhoc')->insert($dataInsertToDatabase);
        if ($insertData) {
            Session::flash('success', 'Thêm môn học thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('admin/monhoc');
    }
    public function index()
    {
        $getData = DB::table('monhoc as mh')
            ->leftJoin('khoa as tenkhoa', 'mh.tenkhoa', '=', 'tenkhoa.tenkhoa')
            ->select('mh.id', 'mh.tenmon', 'mh.tenkhoa', 'mh.tinchi', 'tenkhoa.tenkhoa')->get();
        return view('monhoc.list')->with('listmonhoc', $getData);
    }
    public function edit($id)
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('monhoc')->select('id', 'tenmon', 'tenkhoa', 'tinchi')->where('id', $id)->get();
        return view('monhoc.edit', ['getMonhocById' => $getData, 'dskhoa' => $dskhoa]);
    }
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
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
        $updateData = DB::table('monhoc')->where('id', $request->id)->update([
            'tenmon' => $request->tenmon,
            'tenkhoa' => $request->tenkhoa,
            'tinchi' => $request->tinchi,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        if ($updateData) {
            Session::flash('success', 'Sửa môn học thành công!');
        } else {
            Session::flash('error', 'Sửa thất bại!');
        }
        return redirect('admin/monhoc');
    }
    public function destroy($id)
    {
        $deleteData = DB::table('monhoc')->where('id', '=', $id)->delete();
        if ($deleteData) {
            Session::flash('success', 'Xóa môn học thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect('admin/monhoc');
    }
}
