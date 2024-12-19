<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('about', 'App\Http\Controllers\AboutUsController@list')->name('about');
Route::get('category', 'App\Http\Controllers\CategoryController@list')->name('category');
Route::get('product', 'App\Http\Controllers\ProductController@list')->name('product');
Route::get('product-slide', 'App\Http\Controllers\ProductController@slide')->name('product.slide');
Route::get('product/{id}', 'App\Http\Controllers\ProductController@view')->name('product.view');
Route::get('product/detail/{code}', 'App\Http\Controllers\ProductController@detail')->name('product.detail');
Route::get('contact', 'App\Http\Controllers\ContactController@list')->name('contact');
Route::get('slider', 'App\Http\Controllers\SliderController@list')->name('slider');
Route::get('team', 'App\Http\Controllers\TeamController@list')->name('team');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
