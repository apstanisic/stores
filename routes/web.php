<?php


// Auth and user profile
Auth::routes();
Route::group(['prefix' => 'profile'], function() {
	Route::get('/', 'Auth\UserController@index')->name('user.index');
	Route::patch('/', 'Auth\UserController@update')->name('user.update');
	Route::delete('/', 'Auth\UserController@destroy')->name('user.destroy');
	Route::get('/edit', 'Auth\UserController@edit')->name('user.edit');
	Route::patch('/password', 'Auth\UserController@updatePassword')->name('user.updatePassword');
});


// Stores
Route::resource('stores', 'StoresController');
// Store categories
Route::resource('stores.categories', 'CategoriesController');
Route::get('stores/{store}/categories/{category}/products', 'CategoriesController@products')
	 ->name('stores.categories.products');
// Store products
Route::resource('stores.products', 'ProductsController');
// Store orders
Route::resource('stores.orders', 'OrdersController', ['except' => ['create', 'store']]);
Route::patch('stores/{store}/orders/{order}/status', 'OrdersController@updateStatus')
	  ->name('stores.orders.updateStatus');



// Static pages
Route::group([], function() {
	Route::get('/', 'PagesController@index')->name('root');
	Route::get('/home', 'PagesController@index');
	Route::get('/about', 'PagesController@whyUs')->name('about');
	Route::get('/manuals', 'PagesController@guides')->name('manuals');
	Route::get('/contact', 'PagesController@contact')->name('contact');
});


// For shopping
// Route::group(['prefix' => 'shop'], function() {
	// dd('1234');
	// Route::bind('store', function($value) {
	// 	$user = \App\User::where('slug', Route::input('user'))->first();
	// 	return $user->stores->where('slug', $value)->first();
	// });
// });

// app()->bind(App\Category::class, function() {
// 	//return (new \App\Category)->where('store_id', \App\Store::url()->id)->get();
// 	// dd(request()->store);
// 	// dd(request()->category);
// 	// dd(request()->store->categories->where('slug', request()->category)->first());
// 	return request()->store->categories->where('slug', request()->category)->first();
// 	// return new \App\Category;
// });
// Route::get('/stores/{bla}', function() {
// 	dd(Route::current());
// 	dd(Route::currentRouteAction());
// });

//Route::bind('category', function($value) {
	// dd(\Auth::user()->stores->where('slug', request()->store)->first()->categories->where('slug', $value)->first());
	//return \Auth::user()->stores->where('slug', request()->store)->first()->categories->where('slug', $value)->first();
	// dd(\App\Store::url()->id);
	// dd(request()->store->categories->firsh());
	// dd($value);
	// return request()->store->categories->where('slug', $value)->first();
// });
// Route::group(['middleware' => 'bindCorrectStore'], function() {

