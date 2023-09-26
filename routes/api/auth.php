<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/user')->group(function (){
    Route::post('/register', [AuthController::class, 'register']);
    Route::POST('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/test', [AuthController::class, 'test']);

});

