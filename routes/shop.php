<?php

// Prefix 's'

// Browsing
Route::get('{store}', 'ShoppingController@index')->name('shop.index');
Route::get('{store}/categories', 'ShoppingController@categories')->name('shop.categories.index');
Route::get('{store}/categories/{category}', 'ShoppingController@category')->name('shop.categories.show');
Route::get('{store}/products/{product}', 'ShoppingController@product')->name('shop.products.show');

// Buyer auth, profile and addresses
// Addresses  // 'as' adds a prefix in route names
Route::resource('{store}/addresses', 'AddressesController', ['as' => 'buyer', 'except' => ['show']]);
Route::get('{store}/profile', 'BuyerController@index')->name('buyer.index');
Route::get('{store}/login', 'BuyerController@showLoginForm')->name('buyer.login.show');
Route::post('{store}/login', 'BuyerController@login')->name('buyer.login');
Route::get('{store}/register', 'BuyerController@showRegistrationForm')->name('buyer.register.show');
Route::post('{store}/register', 'BuyerController@register')->name('buyer.register');
Route::post('{store}/logout', 'BuyerController@logout')->name('buyer.logout');


// Cart
Route::get('{store}/cart', 'CartController@index')->name('cart.index');
Route::post('{store}/cart/{product}', 'CartController@changeProduct')->name('cart.store');
Route::patch('{store}/cart/{product}', 'CartController@changeProduct')->name('cart.update');
Route::delete('{store}/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::delete('{store}/cart', 'CartController@destroyAll')->name('cart.destroyAll');

// Orders  // 'as' adds a prefix in route names
Route::resource('{store}/orders', 'BuyerOrdersController', [ 'as' => 'buyer']);
Route::patch('{store}/orders/{order}/pause', 'BuyerOrdersController@togglePause')->name('buyer.orders.pause');