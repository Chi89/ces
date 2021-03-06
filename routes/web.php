<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubjectOfferingController;
use App\Http\Controllers\SubjectOfferingScheduleController;


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

Route::get('/', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [SubjectController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'], "prefix" => "subjects"], function() {
    Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/store', [SubjectController::class, 'store'])->name('subjects.store');
    Route::delete('/delete/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    Route::get('/show/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/edit/{subject}', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::put('/update/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
});

// Route::resource('subjects', SubjectController::class);

Route::resource('courses', CourseController::class)->middleware('auth');
Route::resource('instructors', InstructorController::class)->middleware('auth');
Route::resource('rooms', RoomController::class)->middleware('auth');

Route::group(['middleware' => ['auth'], "prefix" => "subject-offerings"], function() {
    Route::get('/search', [SubjectOfferingController::class, 'search'])->name('subject-offerings.search');
    Route::get('/schedules/{subjectOffering}', [SubjectOfferingController::class, 'showSchedules'])->name('subject-offerings.schedules');
});
Route::resource('subject-offerings', SubjectOfferingController::class)->middleware('auth');

Route::resource('subject-offering-schedules', SubjectOfferingScheduleController::class)->middleware('auth');
Route::group(['middleware' => ['auth'], "prefix" => "subject-offering-schedules"], function() {
    Route::get('/section-schedules/{subjectOffering}', [SubjectOfferingScheduleController::class, 'getSectionSchedules'])->name('subject-offering-schedules.section-schedules');
    Route::get('/room-schedules/{subjectOffering}', [SubjectOfferingScheduleController::class, 'getRoomSchedules'])->name('subject-offering-schedules.room-schedules');
    Route::get('/instructor-schedules/{subjectOffering}', [SubjectOfferingScheduleController::class, 'getInstructorSchedules'])->name('subject-offering-schedules.instructor-schedules');
    
});