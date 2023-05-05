<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsSubscribeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;
use App\Models\NewsSubscribe;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => true]);

Route::middleware('role:MASTER,EMPLOYEE')->group(function(){
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource("user", UserController::class);
    Route::resource("product", ProductController::class);
    Route::resource("category", CategoryController::class);
    Route::resource("promotion", PromotionController::class);
    Route::resource("news-subscribe", NewsSubscribeController::class);

});
