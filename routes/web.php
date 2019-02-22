<?php


Route::get('/', 'PagesController@index')->name('home');

// Auth
Auth::routes();

// User profile
Route::group(['prefix' => 'profile'], function() {
	Route::get('/', 'Auth\UserController@index')->name('user.index');
	Route::patch('/', 'Auth\UserController@update')->name('user.update');
	Route::delete('/', 'Auth\UserController@destroy')->name('user.destroy');
	Route::get('/edit', 'Auth\UserController@edit')->name('user.edit');
	Route::patch('/password', 'Auth\UserController@updatePassword')->name('user.updatePassword');
});


// Stores
Route::resource('stores', 'StoresController');

// Categories
Route::resource('stores.categories', 'CategoriesController');
Route::get('stores/{store}/categories/{category}/products',	'CategoriesController@products')
	->name('stores.categories.products');
     
// Products
Route::resource('stores.products', 'ProductsController');
Route::patch('stores/{store}/products/{product}/remaining', 'ProductsController@updateRemaining')
	->name('stores.products.remaining');
	 
     
// Orders
Route::resource('stores.orders', 'OrdersController', ['except' => ['create', 'store']]);
Route::patch('stores/{store}/orders/{order}/status', 'OrdersController@updateStatus')
	->name('stores.orders.updateStatus');