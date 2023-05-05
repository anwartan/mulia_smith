<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\NewsSubscribeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PromotionController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::get("/products",[ProductController::class, 'index']);
Route::get("/products/{product}",[ProductController::class, 'detail']);
Route::get("/category/filter",[CategoryController::class, 'filter']);

Route::get("/promotion/active",[PromotionController::class,'index']);
Route::post("/news-subscribe",[NewsSubscribeController::class,'addSubscriber']);

Route::get("/wishlist/",[WishlistController::class,'getWishlist']);
Route::get("/wishlist/add/{product}",[WishlistController::class,'addProduct']);

Route::post("/contact-us/send",[ContactUsController::class,'sendContactForm']);


Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [UserController::class, 'logout']);
    
});