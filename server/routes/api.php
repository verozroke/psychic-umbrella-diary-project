<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('message/all', 'App\Http\Controllers\MessageController@getAllMessages');
Route::put('message/update/{id}', 'App\Http\Controllers\MessageController@updateMessageText');
Route::delete('message/delete/{id}', 'App\Http\Controllers\MessageController@delete');

Route::post('person/create', 'App\Http\Controllers\PersonController@create');
Route::get('person/{id}', 'App\Http\Controllers\PersonController@get');
Route::put('person/update/name', 'App\Http\Controllers\PersonController@updateName');



Route::post('file/upload/{user_id}', 'App\Http\Controllers\FileController@upload');
