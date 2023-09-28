<?php

use App\Http\Controllers\admin\adminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api','admin'])->prefix('/v1/admin')->group(function (){

    Route::POST('/course-upload', [adminController::class, 'courseUpload']);
    Route::POST('/course-delete/{id}', [adminController::class, 'courseDelete']);
    Route::get('/all-course', [adminController::class, 'allCourse']);
    Route::get('/all-user', [adminController::class, 'getAllUser']);
    Route::post('/search-user', [adminController::class, 'searchUser']);
    Route::get('/all-student', [adminController::class, 'getAllStudent']);
    Route::get('/all-teacher', [adminController::class, 'getAllTeacher']);
    Route::post('/add-user-info', [adminController::class, 'addUserInfo']);
    Route::post('/update-user-info', [adminController::class, 'updateUserInfo']);
    Route::get('/user-info/{id}', [adminController::class, 'getUserInfo']);

    Route::post('/upload-video', [adminController::class, 'uploadVideo']);
    Route::post('/delete-video/{id}', [adminController::class, 'deleteVideo']);
    Route::get('/all-video', [adminController::class, 'allVideo']);

    Route::post('/upload-result', [adminController::class, 'uploadResult']);
    Route::post('/delete-result/{id}', [adminController::class, 'deleteResult']);
    Route::post('/disable-result/{id}', [adminController::class, 'disableResult']);
    //find result based on course
    Route::get('/get-result/{id}', [adminController::class, 'getResult']);
    Route::post('/search-result', [adminController::class, 'searchResult']);



});
