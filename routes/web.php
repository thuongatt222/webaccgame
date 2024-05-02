<?php

use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NickController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'home']);
Route::get('/dich-vu', [IndexController::class, 'dichvu'])->name('dichvu');
Route::get('/danh-muc-game/{slug}', [IndexController::class, 'danhmucgame'])->name('danhmucgame');
Route::get('/dich-vu/{slug}', [IndexController::class, 'dichvucon'])->name('dichvucon');
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuccon'])->name('danhmuccon');
Route::get('/blogs', [IndexController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{slug}', [IndexController::class, 'blogcon'])->name('blogcon');
Route::get('/acc/{ms}', [IndexController::class, 'detail_acc'])->name('acc');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/choose_category', [NickController::class, 'choose_category'])->name('choose_category');
Route::resource('/category', CategoryController::class);
Route::resource('/slider', SliderController::class);
Route::resource('/blog', BlogController::class);
Route::resource('/accessories', AccessoriesController::class);
Route::resource('/nick', NickController::class);
Route::resource('/gallery', GalleryController::class);
