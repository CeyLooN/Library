<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api_1\BookController;
use App\Http\Controllers\Api_1\User\BookController as UserBookController;
use App\Http\Controllers\Api_1\CategoryController;
use App\Http\Controllers\Api_1\AuthorController;
use App\Http\Controllers\AuthController;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['namespace' => 'App\Http\Controllers\Api_1\User'], function (){
    Route::resource('/book', 'BookController')->middleware('jwt.auth');
    Route::resource('/author', 'AuthorController')->middleware('jwt.auth');
});

Route::apiResource ('books', BookController::class);
Route::apiResource ('categories', CategoryController::class);
Route::apiResource ('authors', AuthorController::class);


