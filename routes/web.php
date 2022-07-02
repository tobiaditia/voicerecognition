<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TheoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [AuthController::class,'index'])->name('login');
Route::post('login', [AuthController::class,'login'])->name('login-store');

Route::group(['middleware'=>['auth']],function (){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('teacher',[TeacherController::class,'index']);
    Route::post('teacher',[TeacherController::class,'store']);
    Route::put('teacher/edit',[TeacherController::class,'update']);
    Route::get('teacher/{id}/edit',[TeacherController::class,'edit']);
    Route::delete('teacher/{id}',[TeacherController::class,'destroy']);

    Route::get('student',[StudentController::class,'index']);
    Route::post('student',[StudentController::class,'store']);
    Route::put('student/edit',[StudentController::class,'update']);
    Route::get('student/{id}/edit',[StudentController::class,'edit']);
    Route::delete('student/{id}',[StudentController::class,'destroy']);

    Route::get('theory',[TheoryController::class,'index']);
    Route::post('theory',[TheoryController::class,'store']);
    Route::put('theory/edit',[TheoryController::class,'update']);
    Route::get('theory/{id}/edit',[TheoryController::class,'edit']);
    Route::delete('theory/{id}',[TheoryController::class,'destroy']);

    Route::get('exam',[ExamController::class,'index']);
    Route::post('exam',[ExamController::class,'store']);
    Route::put('exam/edit',[ExamController::class,'update']);
    Route::get('exam/{id}/edit',[ExamController::class,'edit']);
    Route::delete('exam/{id}',[ExamController::class,'destroy']);
});
