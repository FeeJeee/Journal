<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\JournalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('groups', GroupController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('users', UserController::class);
Route::resource('users.subjects', GradeController::class);

Route::get('journals/{group}', [JournalController::class, 'show'])->name('journals.show');
//Route::resource('journals.groups', JournalController::class)->shallow();
