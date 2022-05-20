<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('user','App\Http\Controllers\UserController@createUser');   //for creating user
Route::post('user/delete','App\Http\Controllers\UserController@deleteUser');  // for deleting user
Route::get('user/get','App\Http\Controllers\UserController@get'); // for retrieving user