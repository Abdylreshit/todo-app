<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

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
Route::group([
     'middleware' => ['auth']
],static function () {
    Route::get('/', [TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todo.store');
    Route::put('/todo/update', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/delete', [TodoController::class, 'delete'])->name('todo.delete');
    Route::post('/todo/image/attach', [TodoController::class, 'attachImages'])->name('todo.attach.images');
    Route::get('/todo/show', [TodoController::class, 'showImage'])->name('todo.image.show');
    Route::put('/todo/image/update', [TodoController::class, 'updateImage'])->name('todo.image.update');
    Route::delete('/todo/image/delete', [TodoController::class, 'deleteImage'])->name('todo.image.delete');

    Route::post('/todo/tag/attach', [TodoController::class, 'attachTag'])->name('todo.attach.tag');
});

// Auth::routes();

Route::get("login", [AuthController::class, 'showLoginForm'])->name('login-form');
Route::post("login", [AuthController::class, 'login'])->name('login');
Route::delete("logout", [AuthController::class, 'logout'])->name('logout');

Route::get("register", [AuthController::class, 'showRegisterForm'])->name('register-form');
Route::post("register", [AuthController::class, 'register'])->name('register');
