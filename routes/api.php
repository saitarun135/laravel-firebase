<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Firebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/get',[TestController::class,'get']);
Route::post('/post',[TestController::class,'Register']);
Route::post('/update',[TestController::class,'Update']);
Route::post('/verify',[TestController::class,'verification']);

Route::post('/register',[UserController::class,'RegisterUser']);
Route::post('/login',[UserController::class,'login']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth-firebase');

Route::post('/event',[UserController::class,'createEvent'])->middleware('auth-firebase');
Route::post('/updateUser',[UserController::class,'updateUser'])->middleware('auth-firebase');
