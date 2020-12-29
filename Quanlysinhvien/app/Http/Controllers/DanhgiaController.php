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
        $dsgv = DB::table('monhoc')->join('giangvien', 'monhoc.tenkhoa', '=', 'giangvien.tenkhoa')->distinct()->select('tengiangvien')->where('giangvien.tenkhoa',  Auth::user()->tenkhoa)->get();
        $dsmon = DB::table('monhoc')->select('id', 'tenmon')->where('tenkhoa',  Auth::user()->tenkhoa)->get();
        return view('thoikhoabieu.create')->with('dstenmon', $dsmon)->with('dstengiangvien', $dsgv);
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'tenmon' => 'required',
                'tengiangvien' => 'required',
            ],
            [
                'tenmon.required' => 'Bạn chưa chon mon!',
                'tengiangvien.required' => 'Bạn chưa chọn giang vien!',
            ]
        );
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
        $dataInsertToDatabase = array(
            'masinhvien' => Auth::user()->ma,
            'sinhvien'  => Auth::user()->name,
            'tenmon' => $tenmon,
            'tengiangvien' => $tengiangvien,
            'email' => $gv->email,
            'tinchi' => $tin->tinchi,
        );
        $insertData = DB::table('thoikhoabieu')->insert($dataInsertToDatabase);
        if ($insertData) {
            Session::flash('success', 'Thêm  thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('/thoikhoabieu');
    }
    public function index()
    {
        $getData = DB::table('thoikhoabieu as hs')
            ->leftJoin('monhoc as tenmon', 'hs.tenmon', '=', 'tenmon.tenmon')
            ->leftJoin('giangvien as tengiangvien', 'hs.tengiangvien', '=', 'tengiangvien.tengiangvien')
            ->select('hs.id', 'hs.sinhvien', 'tenmon.tenmon', 'tengiangvien.tengiangvien', 'hs.tinchi')->where('hs.masinhvien', Auth::user()->ma)->get();
        return view('sinhvien.danhgia')->with('listthoikhoabieu', $getData);
    }
}
