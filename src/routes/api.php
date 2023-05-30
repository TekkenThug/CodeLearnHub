<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TicketController;

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

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'openTicket']);
    Route::get('/news', [NewsController::class, 'get']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::resource('users', UserController::class);

        Route::post('/upload/avatar', [UploadController::class, 'processAvatar']);
    });
});