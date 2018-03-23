<?php

use Illuminate\Http\Request;
use Carbon\Carbon;

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
    // API Check Time Server
    // -----------------------------
    Route::get('/time', function() {
        return Carbon::now();
    });
    
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

    Route::post('/profiles', 'ProfileController@create')
    ->middleware('checkCloseRegister');
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
            Route::group(['middleware' => ['checkUserByUserId']], function () {
                Route::prefix('/{userId}')->group(function () {
                    Route::get('/', 'UserController@getByUserId');
                    Route::get('/answers/{questionId}', 'AnswerController@getById');
                });
            });
        });
        // API Create Staff
        Route::prefix('/staffs')->group(function () {
            Route::post('/', 'StaffController@create');
            Route::get('/nonapprove', 'StaffController@getNonApprove')
            ->middleware('checkAdminByRole');
            Route::get('/{userId}', 'StaffController@getStaff')
            ->middleware('checkUserByUserId');
        });
        // API Register
        Route::prefix('/profiles')->group(function () {
            Route::post('/', 'ProfileController@create')
            ->middleware('checkCloseRegister');
            Route::put('/', 'ProfileController@update')
            ->middleware('checkCloseRegister');
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
        // Route::group(['middleware' => ['checkDeveloperByRole']], function () {    
        // API Role
        Route::prefix('/roles')->group(function () {
            Route::get('/name/{name}', 'RoleController@getByName');
        });
        // API User Role
        Route::prefix('/userroles')->group(function () {
            Route::get('/user_id/{id}', 'UserRoleController@getByUserId');
        });
        // });
        // API Upload
        Route::prefix('/uploads')->group(function () {
            Route::post('/', 'UploadFilesController@create')
            ->middleware('checkCloseRegister');
        });
        // API Question
        Route::prefix('/questions')->group(function () {
            Route::get('/{questionId}', 'QuestionController@getById')
            ->middleware('checkCloseRegister');
            Route::get('/', 'QuestionController@get');
        });
        // API Answer
        Route::prefix('/answers')->group(function () {
            Route::post('/', 'AnswerController@create')
            ->middleware('checkCloseRegister');
            Route::put('/', 'AnswerController@update')
            ->middleware('checkCloseRegister');
            Route::get('/', 'AnswerController@get')
            ->middleware('checkWipperByRole');
            Route::get('/{userId}/count', 'AnswerController@getCountById')
            ->middleware('checkWipperByRole');
        });
        // API Religions
        Route::get('/religions', 'ReligionController@get');
        // API Genders
        Route::get('/genders', 'GenderController@get');
        
        Route::group(['middleware' => ['checkWipperByRole']], function () {
            //API Dashboard
            Route::prefix('/dashboard')->group(function (){
                Route::get('','DashboardController@Index');
                Route::get('/register/success','DashboardController@getAllSuccessRegister');
                Route::get('/register/all','DashboardController@getAllRegister');
                Route::get('/document/success','DashboardController@getAllUserDocSuccess');
                Route::get('/profile/success','DashboardController@getAllProfileSuccess');
            });
            Route::prefix('/approve')->group(function () {
                Route::get('/count/transcript','DashboardController@getCountTranscript');
                Route::get('/count/parentpermission','DashboardController@getCountParentAccept');
            });
            // API Approve
            Route::group(['middleware' => ['checkWipperSpeacialByRole']], function () {
                Route::prefix('/documents')->group(function () {
                    Route::put('/{id}','ApproveController@updateDoc');
                });
                Route::prefix('/approve')->group(function () {
                    Route::get('/{doctype}','ApproveController@Doctype');
                    Route::get('/','ApproveController@Index');
                });
                Route::prefix('/evals')->group(function () {
                    Route::get('/','EvalController@Index');
                    Route::get('/{questionId}','EvalController@getEvalsById');
                });
            });
            // API Staff
            Route::group(['middleware' => ['checkAdminByRole']], function () {
                Route::prefix('/staffs')->group(function () {
                    Route::get('/', 'StaffController@get');
                    Route::post('/{id}/roles', 'RoleController@createWipper');
                });
            });
        });
        
        // API Report Problem
        Route::prefix('/problemtypes')->group(function () {
            Route::get('/', 'ProblemTypeController@getAll');
            Route::get('/{id}', 'ProblemTypeController@getProblemType');
        });

        Route::prefix('/prioritys')->group(function () {
            Route::get('/', 'PriorityController@getAll');
            Route::get('/{id}', 'PriorityController@getPriority');
        });

        Route::prefix('/problems')->group(function () {
            Route::get('/', 'ProblemController@getAll');
            Route::get('/{id}', 'ProblemController@getProblem');
            Route::post('/', 'ProblemController@createProblem');
            Route::put('/{id}', 'ProblemController@updateProblem');
        });

        Route::prefix('/assigns')->group(function () {
            Route::get('/problem_id/{id}', 'AssignController@getByProblemId');
            Route::get('/role_team_id/{id}', 'AssignController@getByRoleTeamId');
            Route::get('/assigned_id/{id}', 'AssignController@getByAssignedId');            
        });

        // API Role Team
        Route::prefix('/roleteams')->group(function () {
            Route::get('/name/{name}', 'RoleTeamController@getByName');
        });
        // API User Role Team
        Route::prefix('/userroleteams')->group(function () {
            Route::get('/user_id/{id}', 'UserRoleTeamController@getByUserId');
        });

        // API Timetable
        Route::prefix('timetables')->group(function () {
            Route::get('/', 'TimetableController@getAll');
            Route::get('/{id}', 'TimetableController@getTimetable');
            Route::get('/role_team_id/{id}', 'TimetableController@getByRoleTeamId');
        });

        // API Announce
        Route::prefix('announces')->group(function () {
            Route::get('/', 'AnnounceController@getAll');
            Route::get('/{id}', 'AnnounceController@getAnnounce');
        });

        // API Expo Token
        Route::prefix('expotokens')->group(function () {
            Route::post('/', 'ExpoTokenController@createToken');
        });

        // API Notification
        Route::prefix('notifications')->group(function () {
            Route::get('/', 'NotificationController@getAll');
            Route::get('/user_id/{id}', 'NotificationController@getByUserId');
        });
    });
});
