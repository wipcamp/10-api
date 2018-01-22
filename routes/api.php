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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// v1
Route::prefix('/v1')->group(function () {
    // API Register
    Route::prefix('/profiles')->group(function () {
        Route::post('/', 'ProfileController@create');
    });
    // API Question
    Route::prefix('/questions')->group(function () {
        Route::get('/', 'QuestionController@get');
    });
    // API Answer
    Route::prefix('/answers')->group(function () {
        Route::post('/', 'AnswerController@create');
    });
    Route::prefix('/answers')->group(function () {
        Route::get('/', 'AnswerController@get');
    });
});
