<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LienheController extends Controller
{
    public function index()
    {
        $getData = DB::table('lienhe')->select('id', 'email', 'noidung')->get();
        return view('lienhe', ['lienhe' => $getData]);
    }
    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'noidung' => 'required'
            ],
            [
                'email.required' => 'Bạn chưa nhập email!',
                'noidung.required' => 'Bạn chưa nhập nội dung!',
            ]
        );
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $email = $allRequest['email'];
        $noidung = $allRequest['noidung'];
        $dataInsertToDatabase = array(
            'email' => $email,
            'noidung' => $noidung,
        );
        $insertData = DB::table('lienhe')->insert($dataInsertToDatabase);
        if ($insertData) {
            Session::flash('success', 'Thêm mới giảng viên thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }
        return redirect('lienhe');
    }
}
