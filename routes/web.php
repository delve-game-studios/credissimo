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

Route::get('/payment/{order_id?}', [
	'uses' => 'CartController@getPayment',
	'as' => 'payment'
]);

Route::get('/payment/stripe', [
	'uses' => 'CartController@getStripe',
	'as' => 'stripe'
]);

Route::post('/payment/stripe', [
	'uses' => 'CartController@postStripe',
	'as' => 'payment.stripe'
]);

Route::get('/orders', [
	'uses' => 'OrdersController@ordersHistory',
	'as' => 'orders.history'
]);

Route::post('/orders/{order_id}', [
	'uses' => 'OrdersController@cancelOrder',
	'as' => 'orders.cancel'
]);

Route::post('/orders/cancel_mass', [
	'uses' => 'OrdersController@cancelOrders',
	'as' => 'orders.cancel_mass'
]);

Route::get('/', function () {
	return redirect()->route('shop.index');
    // return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [
    	'uses' => 'AdminController@index',
    	'as' => 'admin.index'
	]);

    Route::delete('products/mass_destroy', 'ProductsController@massDestroy')->name('products.mass_destroy');
    Route::resource('products', 'ProductsController');
    Route::delete('products/mass_destroy', 'ProductsController@massDestroy')->name('products.mass_destroy');
    Route::resource('orders', 'OrdersController');
    Route::post('orders/store', 'OrdersController@store')->name('orders.store');
    Route::delete('orders/mass_destroy', 'OrdersController@massDestroy')->name('orders.mass_destroy');
    Route::resource('users', 'UsersController');
    Route::delete('uploads/mass_destroy', 'UploadsController@massDestroy')->name('uploads.mass_destroy');
	Route::resource('uploads', 'UploadsController');
    Route::delete('uploads/mass_destroy', 'UploadsController@massDestroy')->name('uploads.mass_destroy');
});
