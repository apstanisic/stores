<?php
// Route::group([], function() {
	// Browsing
	Route::get('{user}/{store}', 'ShoppingController@index')->name('shopping.index');
	Route::get('{user}/{store}/about', 'ShoppingController@about')->name('shopping.about');
	Route::get('{user}/{store}/categories', 'ShoppingController@categories')->name('shopping.categories');
	Route::get('{user}/{store}/category/{category}', 'ShoppingController@category')->name('shopping.category');
	Route::get('{user}/{store}/product/{product}', 'ShoppingController@product')->name('shopping.product');

	// Buyer auth and profile
	Route::get('{user}/{store}/profile', 'BuyerController@index')->name('buyer.index');
	Route::get('{user}/{store}/login', 'BuyerController@showLoginForm')->name('buyer.login.show');
	Route::post('{user}/{store}/login', 'BuyerController@login')->name('buyer.login');
	Route::get('{user}/{store}/register', 'BuyerController@showRegistrationForm')->name('buyer.register.show');
	Route::post('{user}/{store}/register', 'BuyerController@register')->name('buyer.register');
	Route::post('{user}/{store}/logout', 'BuyerController@logout')->name('buyer.logout');

	// Cart
	Route::get('{user}/{store}/cart', 'CartController@index')->name('cart.index');
	Route::post('{user}/{store}/cart/{product}', 'CartController@store')->name('cart.store');
	Route::delete('{user}/{store}/cart/{product}', 'CartController@destroy')->name('cart.destroy');

	// Orders
	Route::resource('{user}/{store}/orders', 'BuyerOrdersController', [ 'as' => 'buyer', 'except' => ['create']]);
	Route::patch('{user}/{store}/orders/{order}/pause', 'BuyerOrdersController@togglePause')->name('buyer.orders.pause');
// });