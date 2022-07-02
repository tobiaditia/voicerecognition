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
    Route::resource('student',StudentController::class);
    Route::resource('theory',TheoryController::class);
    Route::resource('exam',ExamController::class);
});
