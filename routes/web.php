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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/getPlaces', 'HomeController@getPlaces');
Route::get('/getPlace/{id}', 'HomeController@getPlace');
Route::get('/getPrice', 'HomeController@getPrice');

Route::prefix('admin')->middleware(['auth','admin'])->namespace('Admin')->group(function () {
	Route::get('/dashboard','AdminController@dashboard');
	Route::resource('/amount', 'AmountController');
	Route::resource('/item', 'ItemController');
	Route::resource('/medium', 'MediumController');
	Route::resource('/places', 'PlaceController');
	Route::get('/order', 'SalesController@order');
	Route::get('/delivery', "SalesController@delivery");
	Route::get('/delivery/start/{id}','SalesController@deliveryStart');
	Route::get('/delivery/{id}', 'SalesController@deliveryUpdate');
	Route::get('/sales', 'SalesController@sales');
	// Route::post('admin/login/submit','LoginController@checkLogin');
});

Route::get('/admin/login', function () {
	return view('admin.auth.login');
});

Route::get('/checkout', 'HomeController@checkout');
Route::post('/checkout/order', 'HomeController@order');


Route::middleware('auth')->group(function () {
	Route::get('/user/orders/{id}', 'HomeController@userOrder');
});
