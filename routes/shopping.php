<?php

// Browsing
Route::get('{user}/{store}', 'ShoppingController@index')->name('shopping.index');
Route::get('{user}/{store}/about', 'ShoppingController@about')->name('shopping.about');
Route::get('{user}/{store}/categories', 'ShoppingController@categories')->name('shopping.categories.index');
Route::get('{user}/{store}/categories/{category}', 'ShoppingController@category')->name('shopping.categories.show');
Route::get('{user}/{store}/product/{product}', 'ShoppingController@product')->name('shopping.products.show');

// Buyer auth and profile
Route::get('{user}/{store}/profile', 'BuyerController@index')->name('buyer.index');
Route::get('{user}/{store}/login', 'BuyerController@showLoginForm')->name('buyer.login.show');
Route::post('{user}/{store}/login', 'BuyerController@login')->name('buyer.login');
Route::get('{user}/{store}/register', 'BuyerController@showRegistrationForm')->name('buyer.register.show');
Route::post('{user}/{store}/register', 'BuyerController@register')->name('buyer.register');
Route::post('{user}/{store}/logout', 'BuyerController@logout')->name('buyer.logout');

// Addresses
Route::resource('{user}/{store}/addresses', 'AddressesController', ['as' => 'shop']);

// Cart
Route::get('{user}/{store}/cart', 'CartController@index')->name('cart.index');
Route::post('{user}/{store}/cart/{product}', 'CartController@store')->name('cart.store');
Route::delete('{user}/{store}/cart/{product}', 'CartController@destroy')->name('cart.destroy');

// Orders  // 'as' adds a prefix in route names
Route::resource('{user}/{store}/orders', 'BuyerOrdersController', [ 'as' => 'buyer']);
Route::patch('{user}/{store}/orders/{order}/pause', 'BuyerOrdersController@togglePause')->name('buyer.orders.pause');