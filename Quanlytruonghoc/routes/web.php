<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Sửa đường dẫn trang chủ mặc định
Route::get('hocsinh', 'HocsinhController@index'); // Hiển thị danh sách học sinh
Route::get('hocsinh/create', 'HocsinhController@create'); // Thêm mới học sinh
Route::post('hocsinh/create', 'HocsinhController@store'); // Xử lý thêm mới học sinh
Route::get('hocsinh/{id}/edit', 'HocsinhController@edit'); // Sửa học sinh
Route::post('hocsinh/update', 'HocsinhController@update'); // Xử lý sửa học sinh
Route::get('hocsinh/{id}/delete', 'HocsinhController@destroy'); // Xóa học sinh

