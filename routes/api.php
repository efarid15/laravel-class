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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([ 'middleware' => 'auth:api'], function() {
    Route::get('/users', 'UserController@users');
    Route::group(['prefix' => 'user'], function () {
        Route::get('/{user_id}', 'UserController@userDetails');
        Route::get('/name/{id}', 'UserController@userName');
    });

    Route::get('/books', 'BookController@getBooks');
    Route::group(['prefix' => 'book'], function () {
        Route::get('/{id}', 'BookController@getBookDetails');
        Route::post('/', 'BookController@createBook');
        Route::put('/{id}', 'BookController@updateBook');
        Route::delete('/{id}', 'BookController@deleteBook');
    });

  });




