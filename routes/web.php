<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\CheckIfTeacher;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        if (auth()->user()->rol == 'teacher')
            $courses = Course::where('teacher', auth()->id())->get();

        else
            $courses = User::with('courses')->where('id', auth()->id())->first()->courses;

        return view('dashboard', compact('courses'));
    });

    Route::get('/dashboard', function () {

        if (auth()->user()->rol == 'teacher')
            $courses = Course::where('teacher', auth()->id())->get();

        else
            $courses = User::with('courses')->where('id', auth()->id())->first()->courses;

        return view('dashboard', compact('courses'));
    })->name('dashboard');

    Route::middleware([CheckIfTeacher::class])->group(function () {
        Route::view('create-course', 'courses.create')->name('course-form');
        Route::post('course-course', [CourseController::class, 'save'])->name('make-course');
        Route::post('update-course', [CourseController::class, 'update'])->name('update-course');
        Route::get('edit-course/{id}', [CourseController::class, 'edit_view'])->name('edit-course');

        Route::get('members/{id}', [CourseController::class, 'members'])->name('members');

        Route::get('create-task/{id}', [TaskController::class, 'index'])->name('task-form');
        Route::post('create-task', [TaskController::class, 'save'])->name('make-task');
        Route::post('update-task', [TaskController::class, 'update'])->name('update-task');
        Route::get('edit-task/{id}', [TaskController::class, 'edit_view'])->name('edit-task');
    });

    Route::get('course/{id}', [CourseController::class, 'index'])->name('course');
});
