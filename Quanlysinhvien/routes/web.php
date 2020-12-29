
<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('index');
});
// Đăng ký thành viên
Route::get('register', 'Auth\RegisterController@getRegister');
Route::post('register', 'Auth\RegisterController@postRegister');

// Đăng nhập và xử lý đăng nhập
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);

// Đăng xuất
Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);
 Route::get('admin/home', 'HocsinhController@index')->name('home');

 Route::get('admin', 'AdminController@index');

 Route::get('/profile', 'ProfileController@index');
 Route::post('/profile', 'ProfileController@update');

 Route::get('/diemhoctap', 'DiemhoctapController@index');
 Route::get('/xephang', 'XephangController@index');
 Route::get('/danhgia', 'DanhgiaController@index');
 Route::get('/danhgia/{id}/edit', 'DanhgiaController@edit');
//hocsinh
Route::get('admin/sinhvien/create', 'SinhvienController@create');
Route::post('admin/sinhvien/create', 'SinhvienController@store');
Route::get('admin/sinhvien/{id}/edit', 'SinhvienController@edit');
Route::post('admin/sinhvien/update', 'SinhvienController@update');
Route::get('admin/sinhvien/{id}/delete', 'SinhvienController@destroy');
Route::get('admin/sinhvien', 'SinhvienController@index');
//
Route::get('admin/monhoc', 'MonhocController@index');
Route::get('admin/monhoc/create', 'MonhocController@create');
Route::post('admin/monhoc/create', 'MonhocController@store');
Route::get('admin/monhoc/{id}/edit', 'MonhocController@edit'); 
Route::post('admin/monhoc/update', 'MonhocController@update'); 
Route::get('admin/monhoc/{id}/delete', 'MonhocController@destroy');
//
Route::get('admin/giangvien', 'GiangvienController@index');
Route::get('admin/giangvien/create', 'GiangvienController@create');
Route::post('admin/giangvien/create', 'GiangvienController@store');
Route::get('admin/giangvien/{id}/edit', 'GiangvienController@edit'); 
Route::post('admin/giangvien/update', 'GiangvienController@update'); 
Route::get('admin/giangvien/{id}/delete', 'GiangvienController@destroy');

Route::get('danhsachlop', 'GiangvienController@danhsachlop');
Route::get('danhsachlop/{tenmon}', 'DanhsachlopController@index');
// Route::get('danhsachlop/danhsachchitiet/{id}', 'DanhsachlopController@update1');
Route::get('danhsachlop/{tenmon}/{masinhvien}/edit', 'DanhsachlopController@edit');
Route::post('danhsachlop/update', 'DanhsachlopController@update');
Route::post('danhsachlop/up', 'DanhsachlopController@update1');
//
Route::get('/thoikhoabieu', 'ThoikhoabieuController@index');
Route::get('thoikhoabieu/create', 'ThoikhoabieuController@create');
Route::post('thoikhoabieu/create', 'ThoikhoabieuController@store');
Route::get('thoikhoabieu/{id}/delete', 'ThoikhoabieuController@destroy');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/lienhe', 'LienheController@index');
Route::post('/lienhe/update', 'LienheController@index');