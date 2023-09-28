<?php

use App\Http\Controllers\admin\adminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api','admin'])->prefix('/v1/admin')->group(function (){

    Route::POST('/course-upload', [adminController::class, 'courseUpload']);
    Route::POST('/course-delete/{id}', [adminController::class, 'courseDelete']);
    Route::get('/all-course', [adminController::class, 'allCourse']);
    Route::get('/all-user', [adminController::class, 'getAllUser']);
    Route::get('/all-student', [adminController::class, 'getAllStudent']);
    Route::get('/all-teacher', [adminController::class, 'getAllTeacher']);
    Route::post('/add-user-info', [adminController::class, 'addUserInfo']);
    Route::post('/update-user-info', [adminController::class, 'updateUserInfo']);
    Route::get('/user-info/{id}', [adminController::class, 'getUserInfo']);

    Route::post('/upload-video', [adminController::class, 'uploadVideo']);
    Route::post('/delete-video/{id}', [adminController::class, 'deleteVideo']);
    Route::post('/all-video', [adminController::class, 'allVideo']);

});
