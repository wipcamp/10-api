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
        Route::post('/{providerAcc}', 'UserController@getByProviderAcc');
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
        // API Create Staff
        Route::prefix('/staffs')->group(function () {
            Route::post('/', 'StaffController@create');
        });
        // API Register
        Route::prefix('/profiles')->group(function () {
            Route::post('/', 'ProfileController@create');
            Route::put('/', 'ProfileController@update');
            Route::get('/', 'ProfileController@get')
            ->middleware('checkWipperSpeacialByRole');
            Route::get('/{userId}', 'ProfileController@getProfile')
            ->middleware('checkUserByUserId');
        });
        // API Registrants
        Route::prefix('/registrants')->group(function () {
            Route::get('/{userId}', 'ProfileController@getRegistrantsById')
            ->middleware('checkUserByUserId');
            Route::get('/', 'ProfileController@getRegistrants')
            ->middleware('checkWipperSpeacialByRole');
        });
        Route::group(['middleware' => ['checkDeveloperByRole']], function () {    
            // API Role
            Route::prefix('/roles')->group(function () {
                Route::get('/name/{name}', 'RoleController@getByName');
            });
            // API User Role
            Route::prefix('/userroles')->group(function () {
                Route::get('/user_id/{id}', 'UserRoleController@getByUserId');
            });
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
            ->middleware('checkWipperByRole');
        });
        // API Religions
        Route::get('/religions', 'ReligionController@get');
        // API Genders
        Route::get('/genders', 'GenderController@get');
        
        Route::group(['middleware' => ['checkWipperByRole']], function () {
            // API Approve
            Route::group(['middleware' => ['checkWipperSpeacialByRole']], function () {
                Route::prefix('/approve')->group(function () {
                    Route::get('/{doctype}','ApproveController@Doctype');
                    Route::get('/','ApproveController@Index');
                });
            });
            // API Staff
            Route::group(['middleware' => ['checkAdminByRole']], function () {
                Route::prefix('/staffs')->group(function () {
                    Route::get('/', 'StaffController@get');
                    Route::post('/{id}/roles', 'RoleController@createWipper');
                    Route::get('/{id}', 'StaffController@getStaff');
                });
            });
            //API Dashboard
            Route::prefix('/dashboard')->group(function (){
                Route::get('','DashboardController@Index');
            });
            // API Report Problem
            Route::prefix('/problemtypes')->group(function () {
                Route::get('/', 'ProblemTypeController@getAll');
                Route::get('/{id}', 'ProblemTypeController@getProblemType');
            });
            Route::prefix('/problems')->group(function () {
                Route::get('/', 'ProblemController@getAll');
                Route::get('/{id}', 'ProblemController@getProblem');
                Route::post('/', 'ProblemController@createProblem');
                Route::put('/{id}', 'ProblemController@updateProblem');
            });
        });
    });
});
