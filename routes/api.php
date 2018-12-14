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

Route::post('/register','API/UserController@register');

Route::namespace('Admin')->prefix('Admin')->group(function () {
    Route::get('/list','API/AdminController@list');
    Route::post('/verify/{user}','API/AdminController@create');
});
Route::middleware(['auth:jwt', 'verified'])->group(function () {

    Route::post('/login','API/UserController@login');

    Route::namespace('Todo')->prefix('Todo')->group(function () {
        Route::get('/list/{todo}','API/TodoController@list');
        Route::post('/create','API/TodoController@create');
        Route::post('/update/{todo}','API/TodoController@update');
        Route::delete('/delete/{todo}','API/TodoController@delete');
    });
    Route::namespace('Task')->prefix('Task')->group(function () {
        Route::get('/list/{task}','API/TodoController@list');
        Route::post('/create/{todo}','API/TodoController@create');
        Route::post('/update/{create}','API/TodoController@update');
        Route::delete('/delete/{task}','API/TodoController@delete');
    });
});

