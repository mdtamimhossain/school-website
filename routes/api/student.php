<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\student\studentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->prefix('/v1/student')->group(function (){

    Route::get('/user-info', [studentController::class, 'getUserInfo']);
    Route::get('/profile-info', [studentController::class, 'getProfileInfo']);
    //find result based on course
    Route::get('/get-result/{id}', [adminController::class, 'getResult']);
    Route::get('/search-result', [adminController::class, 'searchResult']);

});
