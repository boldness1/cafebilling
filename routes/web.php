<?php

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
    return view('home');
})->name('home');

Auth::routes(['register' => false,
              'reset' => false,
              'verify' => false

]);




Route::get('addto','FoodController@index')->name('index')->middleware('auth');

//Route::post('addto','FoodController@index')->name('index');
Route::get('addto/NewFood','FoodController@NewFood')->middleware('auth');
Route::get('addto/GetEditList','FoodController@GetEditList')->middleware('auth');
Route::post('addto/RemoveFood','FoodController@RemoveFood')->middleware('auth');
Route::get('takeorder','TakeOrderController@index')->middleware('auth');
Route::get('takeorder/get_order','TakeOrderController@get_order')->middleware('auth');
Route::get('billing','BillingController@index')->middleware('auth');
Route::get('basket','BasketController@index')->middleware('auth');
Route::get('basket/calculate_basket','BasketController@calculate_basket')->middleware('auth');
Route::get('basket/sell_basket/{id}','BasketController@sell_basket')->middleware('auth');
Route::get('basket/remove_basket/{id}','BasketController@remove_basket')->middleware('auth');

/*Route::get('test', function () {



});*/


