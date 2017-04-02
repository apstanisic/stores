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

Route::get('/', 'PagesController@index');
Route::get('/pocetna', 'PagesController@index');
Route::get('/cenovnik', 'PagesController@prices');
Route::get('/korisnici', 'PagesController@users');
Route::get('/zasto_mi', 'PagesController@whyUs');
Route::get('/upustva', 'PagesController@guides');
Route::get('/kontakt', 'PagesController@contact');

Auth::routes();

Route::get('/home', 'HomeController@index');