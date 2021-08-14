<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SessionController;
use App\Http\Controllers\Dashboard\TermController;

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


Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/home', [App\Http\Controllers\Dashboard\HomeController::class, 'index'])->name('home');
        Route::get('session', [SessionController::class, 'index'])->name('session');
        Route::post('session', [SessionController::class, 'store']);
        Route::patch('session/{id}', [SessionController::class, 'toogleSessionStatus'])->name('session.update');
        Route::get('term', [TermController::class, 'index'])->name('term');
        Route::post('term', [TermController::class, 'store']);
        Route::patch('term/{id}', [TermController::class, 'toogleTermStatus'])->name('term.update');
    });
});
