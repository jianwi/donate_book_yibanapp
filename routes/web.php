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

Route::view('/',"form")->name('home');

Route::get('/yiban/auth','Auth\Yiban@index')->name('yb_auth');

Route::post('/order/add','OrdersController@store');
Route::get('/orders','OrdersController@index');

Route::get('/t',function (){
   dd(auth()->id());
});

Route::view("/admin",'admin');

Route::post("/order/check/{id}","OrdersController@checkIt");
