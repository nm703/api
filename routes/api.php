<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\PassportAuthController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products', 'App\Http\Controllers\ProductController');

Route::apiResource('/productcategories', 'App\Http\Controllers\ProductCategoryController');

Route::group(['prefix'=>'products'], function (){
    Route::apiResource('/{product}/reviews', 'App\Http\Controllers\ReviewController') ->middleware('auth:api');

});


Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

