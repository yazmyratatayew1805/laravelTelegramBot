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




Route::group(['namespace' => 'App\Http\Controllers'], function (){
    Route::post('/order/store', 'OrderController@store')->name('order.store');
    Route::post('/webhook', 'WebhookController@index');
    Route::post('/post/store', 'PostController@store')->name('post.store');
  	Route::get('/', 'OrderController@feedback')->name('hello');
  	Route::get('/feedback', 'OrderController@feedback')->name('feedback');
  	Route::get('/sethook', 'OrderController@sethook')->name('sethook');
});

