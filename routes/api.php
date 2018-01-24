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
    // API Register
    Route::prefix('/approve')->group(function () {
        Route::get('','ApproveController@Index');
        Route::get('{param1}/{param2?}','ApproveController@WithParams');
    });
    Route::prefix('/dashboard')->group(function (){
        Route::get('');
    });
});