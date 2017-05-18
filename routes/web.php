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


// For store owners
Route::resource('stores', 'StoresController');

Route::resource('stores.products', 'ProductsController');

Route::resource('stores.categories', 'CategoriesController');
Route::get('stores/{store}/categories/{category}/products', 'CategoriesController@products')->name('stores.categories.products');

Route::resource('stores.orders', 'OrdersController', ['except' => ['create', 'store']]);
Route::patch('stores/{store}/orders/{order}/updateStatus', 'OrdersController@updateStatus')->name('stores.orders.updateStatus');

// Auth and user profile
Auth::routes();

Route::group(['prefix' => 'profile'], function() {
	Route::get('/', 'Auth\UserController@index')->name('user.index');
	Route::get('/edit', 'Auth\UserController@edit')->name('user.edit');
	Route::patch('/', 'Auth\UserController@update')->name('user.update');
	Route::patch('/password', 'Auth\UserController@updatePassword')->name('user.updatePassword');
	Route::delete('/', 'Auth\UserController@destroy')->name('user.destroy');
});







// For shopping
Route::group(['prefix' => 'shop'], function() {
	// dd('1234');
	// Route::bind('store', function($value) {
	// 	$user = \App\User::where('slug', Route::input('user'))->first();
	// 	return $user->stores->where('slug', $value)->first();
	// });
});

// Static pages
Route::group([], function() {
	Route::get('/', 'PagesController@index')->name('root');
	Route::get('/home', 'PagesController@index');
	Route::get('/about', 'PagesController@whyUs')->name('about');
	Route::get('/manuals', 'PagesController@guides')->name('manuals');
	Route::get('/contact', 'PagesController@contact')->name('contact');
});


// });