<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ScheduleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[WebController::class,'Home']);

Route::get('/list-student',[StudentController::class,'ListStudent']);
Route::post('/add-student',[StudentController::class,'AddStudent']);
Route::get('/delete-student/{id}',[StudentController::class,'deleteStudent']);
Route::get('/edit-student/{id}',[StudentController::class,'editStudent']);
Route::post('/save-student/{id}',[StudentController::class,'saveStudent']);

Route::get('/list-subject',[SubjectController::class,'ListSubject']);
Route::post('/add-subject',[SubjectController::class,'AddSubject']);
Route::get('/delete-subject/{id}',[SubjectController::class,'deleteSubject']);
Route::get('/edit-subject/{id}',[SubjectController::class,'editSubject']);
Route::post('/save-subject/{id}',[SubjectController::class,'saveSubject']);

Route::get('/list-schedule',[ScheduleController::class,'ListSchedule']);
Route::post('/add-schedule',[ScheduleController::class,'AddSchedule']);
Route::get('/delete-schedule/{id}',[ScheduleController::class,'deleteSchedule']);
Route::get('/edit-schedule/{id}',[ScheduleController::class,'editSchedule']);
Route::post('/save-schedule/{id}',[ScheduleController::class,'saveSchedule']);

Route::get('/list-shift',[ShiftController::class,'ListShift']);
Route::post('/add-shift',[ShiftController::class,'AddShift']);
Route::get('/delete-shift/{id}',[ShiftController::class,'deleteShift']);
Route::get('/edit-shift/{id}',[ShiftController::class,'editShift']);
Route::post('/save-shift/{id}',[ShiftController::class,'saveShift']);
