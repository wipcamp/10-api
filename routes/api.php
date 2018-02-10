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

    // API Get and Create User
    Route::prefix('/users')->group(function () {
        Route::post('/', 'UserController@create');
        Route::post('/{providerAcc}', 'UserController@getByProviderAcc')
        ->middleware('CheckUserByProviderId');
    });
    // -----------------------------
    Route::group(['middleware' => 'jwt.auth'], function () {
        // API User
        Route::prefix('/users')->group(function () {
            // API User with user_id
            Route::prefix('/{userId}')->group(function () {
                Route::get('/answers/{questionId}', 'AnswerController@getById')
                ->middleware('checkUserByUserId');
            });
        });
        // API Register
        Route::prefix('/profiles')->group(function () {
            Route::post('/', 'ProfileController@create');
            Route::put('/', 'ProfileController@update');
            Route::get('/', 'ProfileController@get')
            ->middleware('checkUserByRole');
            Route::get('/{userId}', 'ProfileController@getProfile')
            ->middleware('checkUserByUserId');
        });
        // API Registrants
        Route::prefix('/registrants')->group(function () {
            Route::get('/{userId}', 'ProfileController@getRegistrantsById')
            ->middleware('checkUserByUserId');
            Route::get('/', 'ProfileController@getRegistrants')
            ->middleware('checkUserByRole');
        });
        
        // API Upload
        Route::prefix('/uploads')->group(function () {
            Route::post('/', 'UploadFilesController@create');
        });
        // API Question
        Route::prefix('/questions')->group(function () {
            Route::get('/{questionId}', 'QuestionController@getById');
            Route::get('/', 'QuestionController@get');
        });
        // API Answer
        Route::prefix('/answers')->group(function () {
            Route::post('/', 'AnswerController@create');
            Route::put('/', 'AnswerController@update');
            Route::get('/', 'AnswerController@get')
            ->middleware('checkUserByRole');
        });
        // API Religions
        Route::get('/religions', 'ReligionController@get');
        // API Genders
        Route::get('/genders', 'GenderController@get');
        // API Approve
        Route::prefix('/approve')->group(['middleware' => 'checkUserByRole'], function () {
            Route::get('/{doctype}','ApproveController@Doctype');
            Route::get('/','ApproveController@Index');
        });
        //API Dashboard
        Route::prefix('/dashboard')->group(['middleware' => 'checkUserByRole'], function (){
            Route::get('','DashboardController@Index');
        });
        // API Report Problem
        Route::prefix('/problemtypes')->group(['middleware' => 'checkUserByRole'], function () {
            Route::get('/', 'ProblemTypeController@getAll');
            Route::get('/{id}', 'ProblemTypeController@getProblemType');
        });
        Route::prefix('/problems')->group(['middleware' => 'checkUserByRole'], function () {
            Route::get('/', 'ProblemController@getAll');
            Route::get('/{id}', 'ProblemController@getProblem');
            Route::post('/', 'ProblemController@createProblem');
            Route::put('/{id}', 'ProblemController@updateProblem');
        });
    });
});
