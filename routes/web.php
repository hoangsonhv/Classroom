<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TuitionController;
use App\Http\Controllers\pdfController;

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
//Route::get("login",[WebController::class,"login"]);
Route::post("login",[WebController::class,"store"])->name("login");
Route::middleware('auth')->group(function () {
    Route::get('/', [WebController::class, 'Home']);

    Route::get('/list-student', [StudentController::class, 'ListStudent']);
    Route::get('/tuition-student', [StudentController::class, 'TuitionStudent']);
    Route::post('/add-student', [StudentController::class, 'AddStudent']);
    Route::get('/delete-student/{id}', [StudentController::class, 'deleteStudent']);
    Route::get('/edit-student/{id}', [StudentController::class, 'editStudent']);
    Route::post('/save-student/{id}', [StudentController::class, 'saveStudent']);
    Route::get('/detail-student/{id}', [StudentController::class, 'DetailStudent']);

    Route::get('/list-subject', [SubjectController::class, 'ListSubject']);
    Route::post('/add-subject', [SubjectController::class, 'AddSubject']);
    Route::get('/delete-subject/{id}', [SubjectController::class, 'deleteSubject']);
    Route::get('/edit-subject/{id}', [SubjectController::class, 'editSubject']);
    Route::post('/save-subject/{id}', [SubjectController::class, 'saveSubject']);

    Route::get('/list-schedule', [ScheduleController::class, 'ListSchedule']);
    Route::post('/add-schedule', [ScheduleController::class, 'AddSchedule']);
    Route::get('/delete-schedule/{id}', [ScheduleController::class, 'deleteSchedule']);
    Route::get('/edit-schedule/{id}', [ScheduleController::class, 'editSchedule']);
    Route::post('/save-schedule/{id}', [ScheduleController::class, 'saveSchedule']);

    Route::get('/list-shift', [ShiftController::class, 'ListShift']);
    Route::post('/add-shift', [ShiftController::class, 'AddShift']);
    Route::get('/delete-shift/{id}', [ShiftController::class, 'deleteShift']);
    Route::get('/edit-shift/{id}', [ShiftController::class, 'editShift']);
    Route::post('/save-shift/{id}', [ShiftController::class, 'saveShift']);

    Route::get('/attendance', [AttendanceController::class, 'Attendance']);
    Route::post('/attendances/{id}', [AttendanceController::class, 'Attendances']);
    Route::get('/list-attendance', [AttendanceController::class, 'ListAttendance']);
    Route::get('/delete-attendance/{id}', [AttendanceController::class, 'deleteAttendance']);
    Route::get('/all-attendance', [AttendanceController::class, 'allAttendance']);
    Route::post('/save-attendance/{id}', [AttendanceController::class, 'saveAttendance']);
    Route::get('/edit-attendance/{id}', [AttendanceController::class, 'editAttendance']);

    Route::get('/list-tuition', [TuitionController::class, 'ListTuition']);
    Route::post('/add-shift', [ShiftController::class, 'AddShift']);
    Route::get('/delete-shift/{id}', [ShiftController::class, 'deleteShift']);
    Route::get('/edit-shift/{id}', [ShiftController::class, 'editShift']);
    Route::post('/save-shift/{id}', [ShiftController::class, 'saveShift']);

    Route::get('pdf', [pdfController::class, 'index']);
    Route::post('tuitions/{id}', [pdfController::class, 'AddTuition']);
});
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
