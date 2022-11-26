<?php

use App\Http\Controllers\HomeController;
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

Route::prefix('threads')->controller(ThreadController::class)->group(function () {
    Route::get('show/{id}',  'show')->name('threads.show');

    Route::get('create',  'create')->name('threads.create');
    Route::post('register',  'register')->name('threads.register');
});
