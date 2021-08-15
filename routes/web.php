<?php

use App\Http\Controllers\Dashboard\ClassArm;
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
        Route::delete('class/arms/{id}', [ClassArm::class, 'destroy'])->name("class_arm.delete");
        Route::post('class/arms', [ClassArm::class, 'store']);
    });
    Route::get('class/arms', [ClassArm::class, 'index'])->name("class_arm");
    Route::get('class/arms/create', [ClassArm::class, 'create'])->middleware("clearEditModal")->name('class_arm.create');
    Route::get('class/arms/{id}/edit', [ClassArm::class, 'edit'])->name("class_arm.edit");
    Route::patch('class/arms/{id}', [ClassArm::class, 'update'])->middleware("clearEditModal")->name("class_arm.update");


    /**Class */
    Route::get('classes', [SchoolClass::class, 'index'])->name("classes");
    Route::post('classes', [SchoolClass::class, 'store']);
    Route::patch('classes/{id}', [SchoolClass::class, 'update'])->name("classes.store");
    Route::delete('classes/{id}', [SchoolClass::class, 'destroy'])->name("classes.delete");

    /**Subject */
    Route::get('subjects', [Subject::class, 'index'])->name("subjects");
    Route::post('subjects', [Subject::class, 'store']);
    Route::post('subjects/{id}', [Subject::class, 'update'])->name('subject.update');
    Route::post('subjects/{id}', [Subject::class, 'destroy'])->name('subject.delete');

    /**Class Subject */
    Route::get('classes/subjects', [ClassSubject::class, 'index'])->name('class_subjects');
    Route::post('/classes/subjects', [ClassSubject::class, 'store']);
    Route::delete('/classes/subjects', [ClassSubject::class, 'destroy'])->name('class_subject.delete');
    // });
});
