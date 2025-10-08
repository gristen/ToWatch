<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'index']);

Route::get('/tasks', [TaskController::class, "show"])->name('tasks.show');


Route::get('/login', [LoginController::class, "index"])->name('login');
Route::get('/register', [RegisterController::class, "show"])->name('register');
Route::get('/profile', [ProfileController::class, "show"])->name('profile');

Route::put('/task/{task}',[TaskController::class, "update"])->name('task.update');

Route::post('/task/store', [TaskController::class, "store"])->name('task.store');

Route::post('/register', [RegisterController::class, "store"])->name('register');
Route::post('/login', [LoginController::class, "login"])->name('login');
Route::get('/logout', [LogoutController::class, "logout"])->name('logout');

//admin routes
Route::get('/admin/main',[AdminController::class, "index"])->name('admin.index');
Route::get('/admin/users',[AdminController::class, "index"])->name('admin.index');
Route::get('/admin/films',[AdminController::class, "index"])->name('admin.index');
Route::get('/admin/categories',[AdminController::class, "index"])->name('admin.index');
Route::get('/admin/categories',[AdminController::class, "index"])->name('admin.index');
