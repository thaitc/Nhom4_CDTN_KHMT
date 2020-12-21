<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;

class HocsinhController extends Controller
{
    public function create()
    {
        //Lấy danh sách bảng khối
        $dskhoi = DB::table('tbl_khoi')->select('id', 'tenkhoi')->get();
        //Hiển thị trang thêm học sinh
        return view('hocsinh.create')->with('dskhoi', $dskhoi);
    }
    public function store(Request $request)
    {
        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
        $this->validate(
            $request,
            [
                //Kiểm tra giá trị rỗng
                'tenhocsinh' => 'required',
                'sodienthoai' => 'required',
                'khoi' => 'required',
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'tenhocsinh.required' => 'Bạn chưa nhập tên học sinh!',
                'sodienthoai.required' => 'Bạn chưa nhập số điện thoại!',
                'khoi.required' => 'Bạn chưa chọn khối!',
            ]
        );

        //Lưu hình thẻ khi có file hình
        $gethinhthe = '';
        if ($request->hasFile('hinhthe')) {
            //Hàm kiểm tra dữ liệu
            $this->validate(
                $request,
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'hinhthe' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'hinhthe.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'hinhthe.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            //Lưu hình ảnh vào thư mục public/upload/hinhthe
            $hinhthe = $request->file('hinhthe');
            $gethinhthe = time() . '_' . $hinhthe->getClientOriginalName();
            $destinationPath = public_path('upload/hinhthe');
            $hinhthe->move($destinationPath, $gethinhthe);
        }

        //Lưu file lý lịch khi có file
        $getlylich = '';
        if ($request->hasFile('lylich')) {
            $this->validate(
                $request,
                [
                    //Kiểm tra đúng file đuôi .doc hay .docx và dung lượng không quá 5M
                    'lylich' => 'mimes:doc,docx|max:5120',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'lylich.mimes' => 'Chỉ chấp nhận lý lịch với đuôi .doc .docx',
                    'lylich.max' => 'Lý lịch giới hạn dung lượng không quá 5M',
                ]
            );

            //Lưu file vào thư mục public/upload/lylich
            $lylich = $request->file('lylich');
            $getlylich = time() . '_' . $lylich->getClientOriginalName();
            $destinationPath = public_path('/upload/lylich');
            $lylich->move($destinationPath, $getlylich);
        }

        //Lấy giá trị học sinh đã nhập
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $allRequest  = $request->all();
        $tenhocsinh  = $allRequest['tenhocsinh'];
        $sodienthoai = $allRequest['sodienthoai'];
        $khoi = $allRequest['khoi'];

        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            'tenhocsinh'  => $tenhocsinh,
            'sodienthoai' => $sodienthoai,
            'hinhthe' => $gethinhthe,
            'lylich' => $getlylich,
            'khoi' => $khoi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        //Insert vào bảng tbl_hocsinh
         $insertData = DB::table('tbl_hocsinh')->insert($dataInsertToDatabase);
        // if ($insertData) {
        // 	Session::flash('success', 'Thêm mới học sinh thành công!');
        // }else {                        
        // 	Session::flash('error', 'Thêm thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('hocsinh');
    }
    public function index()
    {
        //Lấy danh sách học sinh từ database
        $getData = DB::table('tbl_hocsinh as hs')
            ->leftJoin('tbl_khoi as khoi', 'hs.khoi', '=', 'khoi.id')
            ->select('hs.id', 'hs.tenhocsinh', 'hs.sodienthoai', 'hs.hinhthe', 'hs.lylich', 'khoi.tenkhoi')->get();

        //Gọi đến file list.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên listhocsinh = $getData
        return view('hocsinh.list')->with('listhocsinh', $getData);
    }
    public function edit($id)
    {
        //Lấy dữ liệu bảng tbl_khoi từ Database
        $dskhoi = DB::table('tbl_khoi')->select('id', 'tenkhoi')->get();

        //Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
        $getData = DB::table('tbl_hocsinh')->select('id', 'tenhocsinh', 'sodienthoai', 'hinhthe','lylich', 'khoi')->where('id', $id)->get();

        //Gọi đến file edit.blade.php trong thư mục "resources/views/hocsinh" với giá trị gửi đi tên getHocSinhById = $getData và dskhoi = $dskhoi
        return view('hocsinh.edit', ['getHocSinhById' => $getData, 'dskhoi' => $dskhoi]);
    }
    public function update(Request $request)
    {
        //Cap nhat sua hoc sinh
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        //Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
        $this->validate(
            $request,
            [
                'tenhocsinh' => 'required',
                'sodienthoai' => 'required',
                'khoi' => 'required',
            ],
            [
                'tenhocsinh.required' => 'Bạn chưa nhập tên học sinh!',
                'sodienthoai.required' => 'Bạn chưa nhập số điện thoại!',
                'khoi.required' => 'Bạn chưa chọn khối!',
            ]
        );

        //Thực hiện lưu thay đổi hình thẻ khi có file
        if ($request->hasFile('hinhthe')) {
            $this->validate(
                $request,
                [
                    'hinhthe' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    'hinhthe.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'hinhthe.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            //Xóa file hình thẻ cũ
            $getHT = DB::table('tbl_hocsinh')->select('hinhthe')->where('id', $request->id)->get();
            if ($getHT[0]->hinhthe != '' && file_exists(public_path('upload/hinhthe/' . $getHT[0]->hinhthe))) {
                unlink(public_path('upload/hinhthe/' . $getHT[0]->hinhthe));
            }

            //Lưu file hình thẻ mới
            $hinhthe = $request->file('hinhthe');
            $gethinhthe = time() . '_' . $hinhthe->getClientOriginalName();
            $destinationPath = public_path('upload/hinhthe');
            $hinhthe->move($destinationPath, $gethinhthe);
            $updateHinhThe = DB::table('tbl_hocsinh')->where('id', $request->id)->update([
                'hinhthe' => $gethinhthe
            ]);
        }

        //Thực hiện lưu thay đổi lý lịch khi có file
        if ($request->hasFile('lylich')) {
            $this->validate(
                $request,
                [
                    'lylich' => 'mimes:doc,docx|max:5120',
                ],
                [
                    'lylich.mimes' => 'Chỉ chấp nhận lý lịch với đuôi .doc .docx',
                    'lylich.max' => 'Lý lịch giới hạn dung lượng không quá 5M',
                ]
            );

            //Xóa file lý lịch cũ
            $getLL = DB::table('tbl_hocsinh')->select('lylich')->where('id', $request->id)->get();
            if ($getLL[0]->lylich != '' && file_exists(public_path('upload/lylich/' . $getLL[0]->lylich))) {
                unlink(public_path('upload/lylich/' . $getLL[0]->lylich));
            }

            //Lưu file lý lịch mới
            $lylich = $request->file('lylich');
            $getlylich = time() . '_' . $lylich->getClientOriginalName();
            $destinationPath = public_path('upload/lylich');
            $lylich->move($destinationPath, $getlylich);
            $updateLylich = DB::table('tbl_hocsinh')->where('id', $request->id)->update([
                'lylich' => $getlylich
            ]);
        }

        //Thực hiện câu lệnh update với các giá trị $request trả về
        $updateData = DB::table('tbl_hocsinh')->where('id', $request->id)->update([
            'tenhocsinh' => $request->tenhocsinh,
            'sodienthoai' => $request->sodienthoai,
            'khoi' => $request->khoi,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Kiểm tra lệnh update để trả về một thông báo
        // if ($updateData) {
        //     Session::flash('success', 'Sửa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Sửa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('hocsinh');
    }
    public function destroy($id)
    {
        //Xoa hoc sinh
        //Thực hiện câu lệnh xóa với giá trị id = $id trả về
        $deleteData = DB::table('tbl_hocsinh')->where('id', '=', $id)->delete();

        //Kiểm tra lệnh delete để trả về một thông báo
        // if ($deleteData) {
        //     Session::flash('success', 'Xóa học sinh thành công!');
        // } else {
        //     Session::flash('error', 'Xóa thất bại!');
        // }

        //Thực hiện chuyển trang
        return redirect('hocsinh');
    }
}
