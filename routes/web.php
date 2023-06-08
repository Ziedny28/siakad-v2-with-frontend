<?php

use App\Models\Task;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AjaxRequestController;
use App\Http\Controllers\StudentPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [AuthController::class, 'login'])->name('login');

/*
these routes accessible for guest
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);
});

/*
these routes accessible for admin
*/
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'admin']);
    route::resource('/teachers', TeacherController::class);
    route::get('/teachers-search', [TeacherController::class, 'search'])->name('teachers.search');
    route::resource('/schedule', ClassRoomController::class);

    route::resource('/students', StudentController::class);
    route::get('/student-search', [StudentController::class, 'search'])->name('student.search');
    route::get('/students/major/{major}', [StudentController::class, 'studentByMajor']); // get classroom by jurusan

    route::resource('/subjects', SubjectController::class);
    Route::view('undefined-fitur', 'admin.blank');
    route::view('/admin-profile', 'admin.my-profile');

    // import
    route::post('/teacher-import', [TeacherController::class, 'import'])->name('teacher.import');
    route::post('/student-import', [StudentController::class, 'import'])->name('student.import');
});

/*
these routes accessible for guest
*/
Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/dashboard-teacher', [DashboardController::class, 'teacher']);

    Route::resource('score', ScoreController::class);

    //we can delete this route after testing
    // Route::controller(ScoreController::class)->group(function () {
    // Route::get('/score/class_room/{id}', 'classRoomScore');
    // Route::get('/score/{id}/create-one', 'createOne');
    // Route::get('/score-choose-edit', 'chooseEdit');
    // Route::get('/score-choose-one/{id}', 'editOne');
    // });

    Route::resource('task', TaskController::class);
    Route::view('undefined-fitur', 'teacher.blank');
    route::view('/teacher-schedule', 'teacher.schedule.index');
    route::view('/teacher-profile', 'teacher.my-profile');

    // route for ajax requests with select
    Route::controller(ScoreController::class)->group(function () {
        Route::get('getClassRoom', 'getClassRoom')->name('getClassRoom');
        Route::get('getTasks', 'getTasks')->name('getTasks');
        Route::get('getStudents', 'getStudents')->name('getStudents');
    });

    // new ajax request with select 2
    Route::controller(AjaxRequestController::class)->group(function () {
        Route::get('selectClassRoom', 'classRoom')->name('classRoom.ajaxrequest');
        Route::get('selectTask/{id}', 'task')->name('task.ajaxrequest');
    });
});

/*
these routes accessible for student
*/
Route::middleware(['auth:student'])->group(function () {
    Route::get('/dashboard-student', [DashboardController::class, 'student']);

    Route::controller(StudentPageController::class)->group(function () {
        Route::get('/student-task', 'studentTask');
        Route::get('/student-score', 'studentScore');
    });

    route::view('/student-schedule', 'student.schedule.index');
    route::view('/student-profile', 'student.my-profile');
});

/*
these routes accessible for all
*/
Route::get('/home', function () {
    return 'page for all';
})->middleware('auth');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
