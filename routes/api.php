<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/user', function (Request $request)
{
	// dd($request->user());
	// dd('hello');
	// dd($request->all()[1]);

	dd(is_numeric('a'));
	dd(5 > 'g');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
