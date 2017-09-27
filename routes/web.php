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
Route::patch('stores/{store}/products/{product}/remaining', 'ProductsController@updateRemaining')
	 ->name('stores.products.remaining');
// Store orders
Route::resource('stores.orders', 'OrdersController', ['except' => ['create', 'store']]);
Route::patch('stores/{store}/orders/{order}/status', 'OrdersController@updateStatus')
	 ->name('stores.orders.updateStatus');



// Static pages
Route::group([], function() {
	Route::get('/', 'PagesController@index')->name('root');
	Route::get('/home', 'PagesController@index');
	Route::get('/about', 'PagesController@about')->name('about');
	// Route::get('/manuals', 'PagesController@guides')->name('manuals');
	// Route::get('/contact', 'PagesController@contact')->name('contact');
});