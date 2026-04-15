<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FavoriteMovieController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;





Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-or-moder'])->group(function () {
    Route::get('dashboard',[AdminController::class, "index"])->name('dashboard');
    Route::resource('roles', RoleController::class)->except(['create','show']);
    Route::resource('users', UserController::class);
    Route::get('tasks', [TaskController::class, "index"])->name('tasks.index');
    Route::put('/task/{task}',[TaskController::class, "update"])->name('task.update');
    Route::post('/task/store', [TaskController::class, "store"])->name('task.store');


    //Route::get('/user/{id}/destroy',[UserController::class,"destroy"])->name('user.destroy');

});


Route::get('/movie/{movie}/{slug?}',[MovieController::class, "show"])->name('movie.show');

Route::post('/users/{user}/follow', [FollowController::class, 'toggle'])
    ->middleware('auth')
    ->name('users.follow');

Route::get('/login', [LoginController::class, "index"])->name('login');
Route::get('/register', [RegisterController::class, "show"])->name('register');
Route::get('/profile', [ProfileController::class, "show"])->name('profile');
Route::get('/profile/{username?}', [ProfileController::class, "showByUsername"])->name('showByUsername');


Route::post('/register', [RegisterController::class, "store"])->name('register');
Route::post('/login', [LoginController::class, "login"])->name('login');
Route::get('/logout', [LogoutController::class, "logout"])->name('logout');

Route::post('/movie/{id}/action', FavoriteMovieController::class)->name('movie.action');


Route::get('/admin/tasks/{type?}', [TaskController::class, 'showTaskList'])
    ->where('type', 'backend|frontend|all')
    ->name('showTaskList');

Route::get('/{type?}', [MainController::class, 'index'])
    ->where('type', 'tv-series|cartoon|anime|movie')
    ->name('home');
