<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

// スレッド
Route::prefix('threads')->controller(ThreadController::class)->group(function () {
    Route::get('show/{thread}',  'show')->name('threads.show');

    Route::get('register',  'register')->name('threads.register');
    Route::post('store',  'store')->name('threads.store');
});

// 投稿
Route::prefix('posts')->controller(PostController::class)->group(function () {
    Route::post('store/{thread}', 'store')->name('posts.store');
});
