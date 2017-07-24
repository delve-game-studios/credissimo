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

Route::get('/shop', [
	'uses' => "ShopController@index",
	'as' => 'shop.index'
]);

Route::get('/shop/{slug}', [
	'uses' => 'ShopController@show',
	'as' => 'shop.show'
]);

Route::get('/cart', [
	'uses' => 'CartController@index',
	'as' => 'cart.index'
]);

Route::post('/cart', [
	'uses' => 'CartController@addCart',
	'as' => 'cart.store'
]);

Route::post('/cart/{id}', [
	'uses' => 'CartController@updateCart',
	'as' => 'cart.update'
]);

Route::get('/cart/{id}', [
	'uses' => 'CartController@deleteCart',
	'as' => 'cart.destroy'
]);

Route::get('/', function () {
	return redirect()->route('shop.index');
    // return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::resource('products', 'ProductsController');
    Route::delete('products/mass_destroy', 'ProductsController@massDestroy')->name('products.mass_destroy');
    Route::resource('products', 'ProductsController');
});
