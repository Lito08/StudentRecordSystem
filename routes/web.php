<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{LecturerController,StudentController,CourseController,GradeController};

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin|lecturer'])
     ->get('/courses', [CourseController::class, 'index'])
     ->name('courses.index');

Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('lecturers', LecturerController::class)->except('show');
    Route::resource('students',  StudentController::class)->except('show');
    Route::resource('courses',   CourseController::class)->except(['show', 'index']);
});

Route::middleware(['auth','role:admin|lecturer'])->group(function () {
    Route::post('courses/{course}/grades',        [GradeController::class,'store'])->name('grades.store');

    /* NEW mark-sheet */
    Route::get ('courses/{course}/grades-sheet',  [GradeController::class,'sheet'])->name('grades.sheet');
    Route::post('courses/{course}/grades-sheet',  [GradeController::class,'saveSheet'])->name('grades.saveSheet');
});

Route::middleware(['auth','role:student'])->get('/my-grades',
    [GradeController::class,'studentView'])->name('grades.my');

require __DIR__.'/auth.php';
