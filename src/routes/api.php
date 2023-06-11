<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProgramLanguageController;
use App\Http\Controllers\AdminController;

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

Route::prefix('v1')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::post('/register', [AuthController::class, 'register']);
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('/landing', [CourseController::class, 'getLandingCourses']);

        Route::middleware('auth:sanctum')->group(function() {
            Route::middleware('role:author')->group(function() {
                Route::post('/', [CourseController::class, 'store']);
            });

            Route::get('/my', [CourseController::class, 'myCourses']);
            Route::get('/authored', [CourseController::class, 'authoredCourses']);
            Route::post('/record', [CourseController::class, 'recordToCourse']);
        });
    });

    Route::get('/courses/active/{id}', [CourseController::class, 'getAvailableCourse']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::post('/tickets', [TicketController::class, 'openTicket']);
    Route::get('/news', [NewsController::class, 'get']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/user', [UserController::class, 'me']);
        
        Route::post('/comments', [CommentController::class, 'post']);
        // Route::get('/lessons', [LessonController::class, 'get']);
        Route::get('/program-languages/accepted', [ProgramLanguageController::class, 'getAcceptedCourses']);

        Route::prefix('users')->group(function() {
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });

        Route::prefix('lessons')->group(function() {
            Route::get('/teach', [LessonController::class, 'getForTeach']);
            Route::post('/check', [LessonController::class, 'checkTest']);
        });

        Route::prefix('upload')->group(function() {
            Route::post('/avatar', [UploadController::class, 'processAvatar']);
            Route::post('/cover', [UploadController::class, 'processCourseCover']);
        });

        Route::middleware('role:admin')->group(function() {
            Route::prefix('admin')->group(function() {
                Route::prefix('users')->group(function() {
                    Route::get('/', [AdminController::class, 'getAllUsers']);
                    Route::put('/update/{id}', [AdminController::class, 'updateUser']);
                    Route::put('/ban/{id}', [AdminController::class, 'banUser']);
                });

                Route::prefix('languages')->group(function() {
                    Route::get('/', [AdminController::class, 'getLanguages']);
                    Route::post('/', [AdminController::class, 'addLanguage']);
                });

                Route::prefix('news')->group(function() {
                    Route::post('/', [AdminController::class, 'postNews']);
                    Route::put('/{id}', [AdminController::class, 'updateNews']);
                    Route::delete('/{id}', [AdminController::class, 'deleteNews']);
                });

                Route::prefix('tickets')->group(function() {
                    Route::post('/resolve/{id}', [AdminController::class, 'checkResolve']);
                    Route::post('/take/{id}', [AdminController::class, 'takeTicket']);
                });
            });
        });
    });
});