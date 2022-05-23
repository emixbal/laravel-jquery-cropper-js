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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/upload', [App\Http\Controllers\UploadController::class, 'index'])->name('upaload_index');
Route::post('/upload', [App\Http\Controllers\UploadController::class, 'scan'])->name('upaload_save');
Route::get('/detail_cropper/{file_name}', [App\Http\Controllers\UploadController::class, 'detail_cropper'])->name('detail_cropper');
Route::post('/remove_path', [App\Http\Controllers\UploadController::class, 'remove_path'])->name('remove_path');
Route::get('/show_image', [App\Http\Controllers\UploadController::class, 'show_image'])->name('show_image');
Route::post('/anggota_save', [App\Http\Controllers\UploadController::class, 'anggota_save'])->name('anggota_save');

Route::get('/uploaded_list', [App\Http\Controllers\UploadController::class, 'uploaded_list'])->name('uploaded_list');
Route::post('/uploaded_list_filter', [App\Http\Controllers\UploadController::class, 'uploaded_list_filter'])->name('uploaded_list_filter');
