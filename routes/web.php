<?php

use App\Http\Controllers\Dashboard\ClassArm;
use App\Http\Controllers\Dashboard\ClassArmController;
use App\Http\Controllers\Dashboard\ClassSubject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SchoolClass;
use App\Http\Controllers\Dashboard\SessionController;
use App\Http\Controllers\Dashboard\Subject;
use App\Http\Controllers\Dashboard\TermController;

// as DashboardClassArm;


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

// Route::get('/dashboard', [HomeController::class, 'index']);

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');


Route::middleware('auth')->prefix('admin')->group(function () {

    // Route::->group(function () {
    Route::get('/home', [App\Http\Controllers\Dashboard\HomeController::class, 'index'])->name('home');

    /**Sessions */
    Route::get('sessions', [SessionController::class, 'index'])->name('session');
    Route::post('sessions', [SessionController::class, 'store']);
    Route::patch('sessions/{id}', [SessionController::class, 'toogleSessionStatus'])->name('session.update');

    /**Class terms */
    Route::get('terms', [TermController::class, 'index'])->name('term');
    Route::post('terms', [TermController::class, 'store']);
    Route::patch('terms/{id}', [TermController::class, 'toogleTermStatus'])->name('term.update');

    /**Class Arm */
    Route::middleware(["clearEditModal", "clearCreateModal"])->group(function () {
        Route::delete('class/arms/{id}', [ClassArmController::class, 'destroy'])->name("class_arm.delete");
        Route::post('class/arms', [ClassArmController::class, 'store']);
    });
    Route::get('class/arms', [ClassArmController::class, 'index'])->name("class_arm");
    Route::get('class/arms/create', [ClassAClassArmController::class, 'edit'])->name("class_arm.edit");
    Route::patch('class/arms/{id}', [ClassArmController::class, 'update'])->middleware("clearEditModal")->name("class_arm.update");


    /**Class */
    Route::middleware(["clearEditModal", "clearCreateModal"])->group(function () {
        Route::delete('classes/{id}', [SchoolClassController::class, 'destroy'])->name("classes.delete");
        Route::post('classes', [SchoolClassController::class, 'store']);
    });
    Route::get('classes', [SchoolClassController::class, 'index'])->name("classes");
    Route::get("classes/create", [SchoolClassController::class, 'create'])->middleware("clearEditModal")->name('classes.create');
    Route::get("classes/{id}/edit", [SchoolClassController::class, 'edit'])->name('classes.edit');
    Route::patch('classes/{id}', [SchoolClassController::class, 'update'])->middleware("clearEditModal")->name("classes.update");

    /**Subject */
    Route::get('subjects', [SubjectController::class, 'index'])->name("subjects");
    Route::post('subjects', [SubjectController::class, 'store']);
    Route::post('subjects/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::post('subjects/{id}', [SubjectController::class, 'destroy'])->name('subject.delete');

    /**Class Subject */
    Route::get('classes/subjects', [ClassSubjectController::class, 'index'])->name('class_subjects');
    Route::post('/classes/subjects', [ClassSubjectController::class, 'store']);
    Route::delete('/classes/subjects', [ClassSubjectController::class, 'destroy'])->name('class_subject.delete');
    // });
});
