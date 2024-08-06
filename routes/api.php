<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\Test;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('signup', [AuthController::class,'signup']);
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout'])->middleware('auth:sanctum');


// Route::middleware('auth:sanctum')->group(function(){
//     Route::apiResource('categories', CategoryController::class);
// });

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('sliders', SliderController::class);
Route::apiResource('pages', PageController::class);
Route::apiResource('settings', SettingController::class);

Route::get('/send-email', [Test::class, 'sendEmail']);

