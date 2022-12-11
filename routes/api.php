<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/products', 'App\Http\Controllers\ProductController');

Route::group(['prefix'=>'products'], function (){
    Route::apiResource('/{product}/reviews}', 'App\Http\Controllers\ReviewController');

});

// Route::group(['prefix'=>'products'], function (){
//     Route::apiResource('/{product}/categories}', 'App\Http\Controllers\ProductCategoryController');

// });