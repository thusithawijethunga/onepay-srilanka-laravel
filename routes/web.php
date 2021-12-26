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


Route::get('/checkout', 'App\\Http\\Controllers\\OnepayController@checkout')->name('onepay.checkout');
Route::post('/checkout-request', 'App\\Http\\Controllers\\OnepayController@checkoutRequest')->name('onepay.checkout-request');
Route::any('/onepay/callback', 'App\\Http\\Controllers\\OnepayController@callback')->name('onepay.callback');
Route::get('/onepay/notify', 'App\\Http\\Controllers\\OnepayController@notify')->name('onepay.notify');