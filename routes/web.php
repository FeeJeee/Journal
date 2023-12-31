<?php

use App\Http\Controllers\web\GradeController;
use App\Http\Controllers\web\GroupController;
use App\Http\Controllers\web\JournalController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SubjectController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('groups', GroupController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('users', UserController::class);
    Route::resource('users.subjects', GradeController::class);

    Route::get('journals/{group}', [JournalController::class, 'show'])->name('journals.show');

    Route::get('users/{user}/pdf', [UserController::class, 'toPdf'])->name('users.pdf');
    Route::get('users/{user}/restore', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
    Route::delete('users/{user}/forceDelete', [UserController::class, 'forceDelete'])->withTrashed()->name('users.forceDelete');
});

require __DIR__ . '/auth.php';
