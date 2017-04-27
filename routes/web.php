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


/* ====== TODO: UserController ======== */

// Staticne stranice
Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/pocetna', 'PagesController@index');
// Route::get('/cenovnik', 'PagesController@prices');
// Route::get('/korisnici', 'PagesController@users');
// Route::get('/zasto_mi', 'PagesController@whyUs');
Route::get('/upustva', 'PagesController@guides');
// Route::get('/kontakt', 'PagesController@contact');


// Autentifikacija
Auth::routes();
Route::get('/profile', 'Auth\UserController@index')->name('user.index');
Route::get('/profile/edit', 'Auth\UserController@edit')->name('user.edit');
Route::patch('/profile', 'Auth\UserController@update')->name('user.update');
Route::patch('/profile/password', 'Auth\UserController@updatePassword')->name('user.updatePassword');
Route::delete('/profile', 'Auth\UserController@destroy')->name('user.destroy');

//Route::get('/home', 'HomeController@index');

Route::resource('stores', 'StoresController');



Route::resource('stores.products', 'ProductsController');
Route::resource('stores.categories', 'CategoriesController');
Route::get('stores/{store}/categories/{category}/products', 'CategoriesController@products')->name('stores.categories.products');


/* Rucni nacin nacin */
// Route::resource('stores/{store}/products', 'ProductsController');
// Route::resource('stores/{store}/categories', 'CategoriesController');
// Route::get('stores/{store}/categories/{category}/products', 'CategoriesController@products')->name('categories.products');