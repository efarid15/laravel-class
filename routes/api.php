<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{user_id}', 'UserController@userDetails');
Route::get('/users', 'UserController@users');
Route::get('/user/name/{id}', 'UserController@userName');

Route::get('/books', 'BookController@getBooks');
Route::get('/book/{id}', 'BookController@getBookDetails');
Route::post('/book', 'BookController@createBook');
Route::put('/book/{id}', 'BookController@updateBook');
Route::delete('/book/{id}', 'BookController@deleteBook');

