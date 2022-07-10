<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TheoryController;
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

Route::post('login', [AuthController::class, 'login']);
Route::get('theory', [TheoryController::class,'index']);
Route::get('theory/{id}', [TheoryController::class,'show']);
Route::get('exam', [TheoryController::class,'index']);
Route::get('exam/{id}', [TheoryController::class,'show']);
Route::middleware('auth:api')->group( function () {
});
