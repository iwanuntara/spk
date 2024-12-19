<?php

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

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', function () {
        return redirect('beranda');
    });
    
    Route::get('beranda', 'App\Http\Controllers\BerandaController@index');
    //user
    Route::get('user', 'App\Http\Controllers\UserController@index')->middleware('checkRole:admin');
    Route::get('user/yajra', 'App\Http\Controllers\UserController@yajra')->middleware('checkRole:admin');
    Route::get('user/add', 'App\Http\Controllers\UserController@add')->middleware('checkRole:admin');
    Route::get('profil', 'App\Http\Controllers\UserController@profile');
    Route::get('password', 'App\Http\Controllers\UserController@password');
    Route::post('/change-password', 'App\Http\Controllers\UserController@changePassword')->name('change.password');
    Route::post('/change-profil', 'App\Http\Controllers\UserController@changeProfil')->name('change.profil');
    Route::post('user/store', 'App\Http\Controllers\UserController@store')->middleware('checkRole:admin,staff');
    Route::get('user/{id}', 'App\Http\Controllers\UserController@edit')->middleware('checkRole:admin,staff');
    Route::put('user/{id}', 'App\Http\Controllers\UserController@update')->middleware('checkRole:admin,staff');
    Route::delete('user/{id}', 'App\Http\Controllers\UserControlle
    r@delete')->middleware('checkRole:admin,staff');

    // Area
    Route::get('area', 'App\Http\Controllers\AreaController@index')->middleware('checkRole:admin,staff');
    Route::get('area/yajra', 'App\Http\Controllers\AreaController@yajra')->middleware('checkRole:admin,staff');
    Route::get('area/add', 'App\Http\Controllers\AreaController@add')->middleware('checkRole:admin,staff');
    Route::post('area', 'App\Http\Controllers\AreaController@store')->middleware('checkRole:admin,staff');
    Route::get('area/{id}', 'App\Http\Controllers\AreaController@edit')->middleware('checkRole:admin,staff');
    Route::put('area/{id}', 'App\Http\Controllers\AreaController@update')->middleware('checkRole:admin,staff');

     // SPK
     Route::get('spk', 'App\Http\Controllers\SpkController@index')->middleware('checkRole:admin,staff');
     Route::get('spk/yajra', 'App\Http\Controllers\SpkController@yajra');
     Route::get('spk/add', 'App\Http\Controllers\SpkController@add')->middleware('checkRole:admin,staff');
     Route::post('spk', 'App\Http\Controllers\SpkController@store')->middleware('checkRole:admin,staff');
     Route::get('spk/{id}', 'App\Http\Controllers\SpkController@view')->middleware('checkRole:admin,staff');
     Route::get('spk/edit/{id}', 'App\Http\Controllers\SpkController@edit')->middleware('checkRole:admin,tehnik,qa');
     Route::put('spk/{id}', 'App\Http\Controllers\SpkController@update')->middleware('checkRole:admin,staff');
     Route::get('pengajuan-spk', 'App\Http\Controllers\SpkController@index')->middleware('checkRole:admin,tehnik,qa');

     // Mesin
     Route::get('mesin', 'App\Http\Controllers\MesinController@index')->middleware('checkRole:admin,staff');
     Route::get('mesin/yajra', 'App\Http\Controllers\MesinController@yajra')->middleware('checkRole:admin,staff');
     Route::get('mesin/add', 'App\Http\Controllers\MesinController@add')->middleware('checkRole:admin,staff');
     Route::post('mesin', 'App\Http\Controllers\MesinController@store')->middleware('checkRole:admin,staff');
     Route::get('mesin/{id}', 'App\Http\Controllers\MesinController@edit')->middleware('checkRole:admin,staff');
     Route::put('mesin/{id}', 'App\Http\Controllers\MesinController@update')->middleware('checkRole:admin,staff');

     
});

Auth::routes();

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
