<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('blank.blank');
});

// page accessible for guest
Route::middleware('guest')->group(function(){
    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::post('/login',[AuthController::class, 'processLogin']);
});

// page accessible for admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard-admin',[DashboardController::class, 'admin']);
    route::resource('/teachers', TeacherController::class);
    route::resource('/students', StudentController::class);
});

// page accessible for teacher
Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/dashboard-teacher',[DashboardController::class, 'teacher']);
    Route::resource('score', ScoreController::class);
    Route::get('/score/{id}/create-one',[ ScoreController::class,'createOne']);
    Route::get('/score-choose-edit',[ ScoreController::class,'chooseEdit']);
    Route::get('/score-choose-one/{id}',[ ScoreController::class,'editOne']);
    Route::resource('task', TaskController::class);
});


// page accessible for student
Route::middleware(['auth:student'])->group(function () {
    Route::get('/dashboard-student',[DashboardController::class, 'student']);
});

// page accessible for all
Route::get('/home',function(){
    return 'page for all';
})->middleware('auth');


// logout
Route::get('/logout',[AuthController::class, 'logout'])->name('logout')->middleware('auth');
