<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\student\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/v1')->group(function (){

    Route::post('/all-video', [adminController::class, 'allVideo']);
    Route::post('/admission', [studentController::class, 'admission']);

});

require('routes/api/auth.php');
require('routes/api/admin.php');
require('routes/api/student.php');
