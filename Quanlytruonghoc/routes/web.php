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
 Route::get('/home', 'HocsinhController@index')->name('home');
//hocsinh
Route::get('hocsinh/create', 'HocsinhController@create'); // Thêm mới học sinh
Route::post('hocsinh/create', 'HocsinhController@store'); // Xử lý thêm mới học sinh
Route::get('hocsinh/{id}/edit', 'HocsinhController@edit'); // Sửa học sinh
Route::post('hocsinh/update', 'HocsinhController@update'); // Xử lý sửa học sinh
Route::get('hocsinh/{id}/delete', 'HocsinhController@destroy'); // Xóa học sinh
Route::get('/hocsinh', 'HocsinhController@index');
//
Route::get('monhoc', 'MonhocController@index');
Route::get('monhoc/create', 'MonhocController@create');
Route::post('monhoc/create', 'MonhocController@store');
Route::get('monhoc/{id}/edit', 'MonhocController@edit'); 
Route::post('monhoc/update', 'MonhocController@update'); 
Route::get('monhoc/{id}/delete', 'MonhocController@destroy');
//
Route::get('giangvien', 'GiangvienController@index');
Route::get('giangvien/create', 'GiangvienController@create');
Route::post('giangvien/create', 'GiangvienController@store');
Route::get('giangvien/{id}/edit', 'GiangvienController@edit'); 
Route::post('giangvien/update', 'GiangvienController@update'); 
Route::get('monhoc/{id}/delete', 'GiangvienController@destroy');
