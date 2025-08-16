<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', [\App\Http\Controllers\MovieController::class,"index"]);
Route::get('/login',[]);
Route::get('/login',[]);
Route::get('/register',[]);
Route::get('/categories',[]);*/
Route::post('/test', [\App\Http\Controllers\MovieController::class,"index"])->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
