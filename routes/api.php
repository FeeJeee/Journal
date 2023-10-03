<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\GradeController;
use App\Http\Controllers\api\GroupController;
use App\Http\Controllers\api\SubjectController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

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
Route::name('api.')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('resetPassword', [AuthController::class, 'resetPassword']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::resource('users', UserController::class);
        Route::resource('groups', GroupController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('users.subjects', GradeController::class);

        Route::get('users/{user}/pdf', [UserController::class, 'toPdf']);
    });
});
