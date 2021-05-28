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

		// Get Price and Place
		Route::get('/', 'HomeController@index')->name('home');
		Route::get('/getPlaces', 'HomeController@getPlaces');
		Route::get('/getPlace/{id}', 'HomeController@getPlace');
		Route::get('/getPrice', 'HomeController@getPrice');

//    Admin Routes

	Route::prefix('admin')->middleware(['auth','admin'])->namespace('Admin')->group(function () {
		Route::get('/',function(){
			return redirect('/admin/dashboard');
		});
		Route::get('dashboard','AdminController@dashboard');
		Route::get('transaction','AdminController@transaction');
		Route::resource('amount', 'AmountController');
		Route::resource('item', 'ItemController');
		Route::resource('medium', 'MediumController');
		Route::resource('places', 'PlaceController');
		Route::get('order', 'SalesController@order');
		Route::get('delivery', "SalesController@delivery");
		Route::get('delivery/start/{id}','SalesController@deliveryStart');
		Route::get('delivery/cancel/{id}','SalesController@deliveryCancel');
		Route::get('delivery/{id}', 'SalesController@deliveryUpdate');
		Route::get('sales', 'SalesController@sales');
		Route::get('order/edit/{id}','SalesController@editOrder');
		Route::get('order/delete/{id}','SalesController@deleteOrder');
		Route::post('order/update/{id}','SalesController@updateOrder');
		Route::get('edit','AdminController@edit');
		Route::post('update/{id}',"AdminController@update");
		Route::get('/password','AdminController@changePassword');
		Route::post('/updatePassword/{id}','AdminController@updatePassword');
	});
// Guest and Others
		Route::get('about','HomeController@about');
		Route::get('contact','HomeController@contact');
		Route::get('checkout', 'HomeController@checkout');
		Route::get('order',"HomeController@checkOrder");
		Route::post('checkout/order', 'HomeController@order');
		Route::get('guest/order','Homecontroller@guestOrder');
		Route::get('checkout/payment/{order}','Homecontroller@payment');
		Route::post('/checkout/payment/{order}/esewa/process', [
			'name' => 'eSewa Checkout Payment',
			'as' => 'checkout.payment.esewa.process',
			'uses' => 'EsewaController@payment',
		]);

		Route::get('/checkout/payment/{order}/esewa/completed', [
			'name' => 'eSewa Payment Completed',
			'as' => 'checkout.payment.esewa.completed',
			'uses' => 'EsewaController@completed',
		]);

		Route::get('/checkout/payment/{order}/failed', [
			'name' => 'eSewa Payment Failed',
			'as' => 'checkout.payment.esewa.failed',
			'uses' => 'EsewaController@failed',
		]);
// User Routes
	Route::middleware('auth')->group(function () {
		Route::get('user/info', 'HomeController@userInfo');
		Route::get('user/info/edit','HomeController@userEdit');
	    Route::post('user/info/update','HomeController@userUpdate');

	});
