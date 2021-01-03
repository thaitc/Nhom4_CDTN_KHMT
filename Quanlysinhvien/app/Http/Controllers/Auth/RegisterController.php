<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('auth/register');
    }
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'ma' => 'required|string|max:255|unique:users',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ],
            [
                'ma.unique' => 'Mã sinh viên đã tồn tại',
                'name.required' => 'Họ và tên là trường bắt buộc',
                'name.max' => 'Họ và tên không quá 255 ký tự',
                'email.required' => 'Email là trường bắt buộc',
                'email.email' => 'Email không đúng định dạng',
                'email.max' => 'Email không quá 255 ký tự',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu là trường bắt buộc',
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
            ]
        );
    }
    protected function create(array $data)
    {
        return User::create([
            'ma'=>$data['ma'],
            'name' => $data['name'],
            'email' => $data['email'],
            'tenkhoa' =>'',
            'level' => '3',
            'password' => bcrypt($data['password']),
        ]);
    }
    public function postRegister(Request $request)
    {

        // Kiểm tra dữ liệu vào
        $allRequest  = $request->all();
        $validator = $this->validator($allRequest);

        if ($validator->fails()) {
            // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
            return redirect('register')->withErrors($validator)->withInput();
        } else {
            // Dữ liệu vào hợp lệ sẽ thực hiện tạo người dùng dưới csdl
            if ($this->create($allRequest)) {
                $email = $request['email'];
                $name = $request['name'];
                $masinhvien = $request['ma'];
                $dataInsertToDatabase = array(
                    'masinhvien'  => $masinhvien,
                    'hoten' => $name,
                    'email' => $email,
                    'tenkhoa' => '',
                    'diachi' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                //Insert vào bảng tbl_hocsinh
                $insertData = DB::table('sinhvien')->insert($dataInsertToDatabase);
                // Insert thành công sẽ hiển thị thông báo
                Session::flash('success', 'Đăng ký thành viên thành công!');
                return redirect('login');
            } else {
                // Insert thất bại sẽ hiển thị thông báo lỗi
                Session::flash('error', 'Đăng ký thành viên thất bại!');
                return redirect('register');
            }
        }
    }
}
