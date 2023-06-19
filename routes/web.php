<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentPageController;
use App\Http\Controllers\TeacherPageController;

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
    route::get('/teachers-search', [TeacherController::class, 'search'])->name('teachers.search');

    route::resource('/teachers', TeacherController::class);
    route::resource('/schedule', ClassRoomController::class);
    route::resource('/students', StudentController::class);
    route::resource('/subjects', SubjectController::class);

    Route::view('undefined-fitur', 'admin.blank');
    route::view('/admin-profile', 'admin.my-profile');

    Route::controller(ClassRoomController::class)->group(function () {
        route::get('/schedule/{classRoom}/schedule_edit', 'scheduleEdit');
        route::post('/schedule_upload', 'scheduleUpload');
    });

    Route::controller(StudentController::class)->group(function () {
        route::get('/student-search', 'search')->name('student.search');
        route::get('/students/major/{major}', 'studentByMajor'); // get classroom by jurusan
    });

    // import
    route::post('/teacher-import', [TeacherController::class, 'import'])->name('teacher.import');
    route::post('/student-import', [StudentController::class, 'import'])->name('student.import');
});

/*
these routes accessible for teacher
*/
Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/dashboard-teacher', [DashboardController::class, 'teacher']);
    Route::get('/score-search', [ScoreController::class, 'search'])->name('score.search');

    Route::resource('/score', ScoreController::class);
    Route::resource('task', TaskController::class);

    Route::view('undefined-fitur', 'teacher.blank');

    Route::controller(TeacherPageController::class)->group(function () {
        Route::get('/teacher-change-password', 'changePassword');
        Route::post('/teacher-save-change-password', 'saveChangePassword');
        route::get('/teacher-profile', 'teacherProfile');
        route::get('/teacher-schedule', 'teacherSchedule');
    });

    // route for ajax requests with select
    Route::controller(ScoreController::class)->group(function () {
        Route::get('getClassRoom', 'getClassRoom')->name('getClassRoom');
        Route::get('getTasks', 'getTasks')->name('getTasks');
        Route::get('getStudents', 'getStudents')->name('getStudents');
    });

    // new ajax request with select 2
    // Route::controller(AjaxRequestController::class)->group(function () {
    //     Route::get('selectClassRoom', 'classRoom')->name('classRoom.ajaxrequest');
    //     Route::get('selectTask/{id}', 'task')->name('task.ajaxrequest');
    // });
});

/*
routes accessible for student
*/
Route::middleware(['auth:student'])->group(function () {
    Route::get('/dashboard-student', [DashboardController::class, 'student']);

    Route::controller(StudentPageController::class)->group(function () {
        Route::get('/student-task', 'studentTask');
        Route::get('/student-score', 'studentScore');
        Route::get('/student-schedule', 'studentSchedule');
        Route::get('/student-profile', 'studentProfile');
        Route::get('/student-change-password', 'changePassword');
        Route::post('/student-save-change-password', 'saveChangePassword');
    });
});

/*
routes accessible for all authenticated user
*/
Route::get('/home', function () {
    return 'page for all';
})->middleware('auth');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
