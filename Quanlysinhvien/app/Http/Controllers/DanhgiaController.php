<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Collective\Html\FormFacade;
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
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'tenmon' => 'required',
                'tengiangvien' => 'required',
                'tenkhoa' => 'required',
                'danhgia' => 'required',
                'danhgia1' => 'required',
                'danhgia2' => 'required',
                'danhgia3' => 'required',
                'danhgia4' => 'required',
                'danhgia5' => 'required',
                'danhgia6' => 'required',
                'danhgia7' => 'required',
                'danhgia8' => 'required',
                'danhgia9' => 'required',
            ],
            [
                'tenmon.required' => 'Bạn chưa chon môn!',
                'tengiangvien.required' => 'Bạn chưa chọn giảng viên!',
                'danhgia.required' => 'Bạn chưa chọn đủ các tiêu chí!',
            ]
        );
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tenmon = $allRequest['tenmon'];
        $tengiangvien = $allRequest['tengiangvien'];
        $tenkhoa= $allRequest['tenkhoa'];
        $diem1 = $allRequest['danhgia'];
        $diem2 = $allRequest['danhgia1'];
        $diem3 = $allRequest['danhgia2'];
        $diem4 = $allRequest['danhgia3'];
        $diem5 = $allRequest['danhgia4'];
        $diem6 = $allRequest['danhgia5'];
        $diem7 = $allRequest['danhgia6'];
        $diem8 = $allRequest['danhgia7'];
        $diem9 = $allRequest['danhgia8'];
        $diem10 = $allRequest['danhgia9'];
        $ykienkhac= $allRequest['ykienkhac'];
        $email = DB::table('giangvien')->select('email')->where('tengiangvien',  $request->input('tengiangvien'))->get();
        foreach ($email as $gv) {
            $gv->email;
        }
        $dataInsertToDatabase = array(
            'tenmon' => $tenmon,
            'tenkhoa' => $tenkhoa,
            'tengiangvien' => $tengiangvien,
            'email' => $gv->email,
            'tieuchi1'=> $diem1,
            'tieuchi2'=> $diem2,
            'tieuchi3'=> $diem3,
            'tieuchi4'=> $diem4,
            'tieuchi5'=> $diem5,
            'tieuchi6'=> $diem6,
            'tieuchi7'=> $diem7,
            'tieuchi8'=> $diem8,
            'tieuchi9'=> $diem9,
            'tieuchi10'=> $diem10,
            'diemtb'=> ($diem1+$diem2+$diem3+$diem4+$diem5+$diem6+$diem7+$diem8+$diem9+$diem10)/10,
            'ykien'=> $ykienkhac,
            'ngaydanhgia' => date('Y-m-d H:i:s')
        );
        $insertData = DB::table('danhgiagiangvien')->insert($dataInsertToDatabase);
        if ($insertData) {
            Session::flash('success', 'Đánh giá giảng viên  thành công!');
        } else {
            Session::flash('error', ' Thất bại!');
        }
        return redirect('/danhgia');
    }
    public function index()
    {
        $getData = DB::table('thoikhoabieu as hs')
            ->leftJoin('monhoc as tenmon', 'hs.tenmon', '=', 'tenmon.tenmon')
            ->leftJoin('giangvien as tengiangvien', 'hs.tengiangvien', '=', 'tengiangvien.tengiangvien')
            ->select('hs.id', 'hs.sinhvien', 'tenmon.tenmon', 'tengiangvien.tengiangvien', 'hs.tinchi')->where('hs.masinhvien', Auth::user()->ma)->get();
        return view('sinhvien.danhgia')->with('listthoikhoabieu', $getData);
    }
    public function create($id)
    {
        $dskhoa = DB::table('khoa')->select('id', 'tenkhoa')->get();
        $getData = DB::table('thoikhoabieu')->select('id', 'tenmon','tengiangvien','tenkhoa', 'sinhvien', 'diem')->where('id', $id)->get();
        return view('sinhvien.danhgia_edit', ['getTKBById' => $getData, 'dskhoa' => $dskhoa]);
    }
}
