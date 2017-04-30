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

// For store owners
Route::resource('stores', 'StoresController');
Route::resource('stores.products', 'ProductsController');
Route::resource('stores.categories', 'CategoriesController');
Route::get('stores/{store}/categories/{category}/products', 'CategoriesController@products')->name('stores.categories.products');


// Auth and user profile
Auth::routes();
Route::get('/profile', 'Auth\UserController@index')->name('user.index');
Route::get('/profile/edit', 'Auth\UserController@edit')->name('user.edit');
Route::patch('/profile', 'Auth\UserController@update')->name('user.update');
Route::patch('/profile/password', 'Auth\UserController@updatePassword')->name('user.updatePassword');
Route::delete('/profile', 'Auth\UserController@destroy')->name('user.destroy');

// Cart
Route::get('shop/{user}/{store}/cart', 'CartController@index')->name('cart.index');
Route::post('shop/{user}/{store}/cart/{product}', 'CartController@store')->name('cart.store');
Route::delete('shop/{user}/{store}/cart/{product}', 'CartController@destroy')->name('cart.destroy');


// For shopping
Route::get('shop/{user}/{store}', 'ShoppingController@index')->name('shopping.index');
Route::get('shop/{user}/{store}/about', 'ShoppingController@about')->name('shopping.about');
Route::get('shop/{user}/{store}/categories', 'ShoppingController@categories')->name('shopping.categories');
Route::get('shop/{user}/{store}/category/{category}', 'ShoppingController@category')->name('shopping.category');
Route::get('shop/{user}/{store}/{product}', 'ShoppingController@product')->name('shopping.product');


// Static pages
Route::get('/', 'PagesController@index')->name('root');
Route::get('/home', 'PagesController@index');
Route::get('/about', 'PagesController@whyUs')->name('about');
Route::get('/manuals', 'PagesController@guides')->name('manuals');
Route::get('/contact', 'PagesController@contact')->name('contact');
