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

// Route::middleware('auth:api')->get('/users', function (Request $request) {
//     return $request->user();
// });

// v1
Route::prefix('/v1')->group(function () {
    // -----------------------------
    // API Auth
    // -----------------------------
    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });
    // -----------------------------

    // API User
    Route::prefix('/users')->group(function () {
        // API User with user_id
        Route::post('/{providerAcc}', 'UserController@getByProviderAcc');
        Route::post('/', 'UserController@create');
        Route::prefix('/{user_id}')->group(function () {
            Route::get('/answers/{question_id}', 'AnswerController@getById');
        });
    });
    // API Register
    Route::prefix('/profiles')->group(function () {
        Route::post('/', 'ProfileController@create');
        Route::put('/', 'ProfileController@update');
        Route::get('/', 'ProfileController@get');
    });
    // API Registrants
    Route::get('/registrants', 'ProfileController@getRegistrants');
    
    // API Upload
    Route::prefix('/uploads')->group(function () {
        Route::post('/', 'UploadFilesController@create');
    });
    // API Question
    Route::prefix('/questions')->group(function () {
        Route::get('/{question_id}', 'QuestionController@getById');
        Route::get('/', 'QuestionController@get');
    });
    // API Answer
    Route::prefix('/answers')->group(function () {
        Route::post('/', 'AnswerController@create');
        Route::get('/', 'AnswerController@get');
        Route::put('/', 'AnswerController@update');
    });
    // API Religions
    Route::get('/religions', 'ReligionController@get');
    // API Genders
    Route::get('/genders', 'GenderController@get');
    // API Approve
    Route::prefix('/approve')->group(function () {
        Route::get('/{doctype}','ApproveController@Doctype');
        Route::get('/','ApproveController@Index');
    });
    //API Dashboard
    Route::prefix('/dashboard')->group(function (){
        Route::get('','DashboardController@Index');
    });
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
