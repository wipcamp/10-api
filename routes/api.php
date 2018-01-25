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


Route::prefix('/v1')->group(function () {
    // API Report Problem
    Route::prefix('/problemtype')->group(function () {
        Route::get('/', 'ProblemTypeController@getAll');
        Route::get('/{id}', 'ProblemTypeController@getProblemType');
    });

    Route::prefix('/problem')->group(function () {
        Route::get('/', 'ProblemController@getAll');
        Route::get('/{id}', 'ProblemController@getProblem');
        Route::post('/', 'ProblemController@createProblem');
        Route::put('/{id}', 'ProblemController@updateProblem');
    });
});
