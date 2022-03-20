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

Route::get('/', [\App\Http\Controllers\PageController::class,'index'])->name('index');
Route::get('/detail/{slug}',[\App\Http\Controllers\PageController::class,'detail'])->name('post.detail');
Route::get('/job-test',[\App\Http\Controllers\PageController::class,'jobTest'])->name('job-test');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('post',\App\Http\Controllers\PostController::class);
Route::resource('comment',\App\Http\Controllers\CommentController::class);
Route::resource('gallery',\App\Http\Controllers\GalleryController::class);
Route::get('edit-profile',[\App\Http\Controllers\ProfileController::class,'edit'])->name('edit-profile');
Route::post('update-profile',[\App\Http\Controllers\ProfileController::class,'update'])->name('update-profile');
Route::get('change-password',[\App\Http\Controllers\ProfileController::class,'changePassword'])->name('change-password');
Route::post('update-password',[\App\Http\Controllers\ProfileController::class,'updatePassword'])->name('update-password');
