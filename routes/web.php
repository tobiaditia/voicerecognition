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
Route::get('logout', [AuthController::class,'logout'])->name('logout');

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
    Route::get('theory/add',[TheoryController::class,'add']);
    Route::post('theory',[TheoryController::class,'store']);
    Route::get('theory/{id}/edit',[TheoryController::class,'edit']);
    Route::put('theory/{id}',[TheoryController::class,'update']);
    Route::delete('theory/{id}',[TheoryController::class,'destroy']);

    Route::get('exam',[ExamController::class,'index']);
    Route::get('exam/add',[ExamController::class,'add']);
    Route::post('exam',[ExamController::class,'store']);
    Route::post('examuserdetail',[ExamController::class,'examuserdetail']);
    Route::post('exam/{id}',[ExamController::class,'update']);
    Route::get('exam/{id}/edit',[ExamController::class,'edit']);
    Route::get('exam/{id}/hasil',[ExamController::class,'hasil']);
    Route::get('exam/{id}/hasil/{exam_user_id}',[ExamController::class,'hasilUser']);
    Route::delete('exam/{id}',[ExamController::class,'destroy']);
});
