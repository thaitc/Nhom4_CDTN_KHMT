<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome');
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

//hocsinh
Route::get('admin/hocsinh/create', 'HocsinhController@create'); // Thêm mới học sinh
Route::post('admin/hocsinh/create', 'HocsinhController@store'); // Xử lý thêm mới học sinh
Route::get('admin/hocsinh/{id}/edit', 'HocsinhController@edit'); // Sửa học sinh
Route::post('admin/hocsinh/update', 'HocsinhController@update'); // Xử lý sửa học sinh
Route::get('admin/hocsinh/{id}/delete', 'HocsinhController@destroy'); // Xóa học sinh
Route::get('admin/hocsinh', 'HocsinhController@index');
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
Route::get('admin/monhoc/{id}/delete', 'GiangvienController@destroy');
