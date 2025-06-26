<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FuelsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetlangController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['lang', 'auth'])->group(function () {

    Route::get('welcome', function () {
        return view('welcome');
    })->name('home');
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('dashboard', function () {
        return view('welcome');
    })->name('home');
    Route::get('index', function () {
        return view('welcome');
    })->name('home');
    Route::get('default', function () {
        return view('welcome');
    })->name('home');
    Route::get('home', function () {
        return view('welcome');
    })->name('home');

    Route::resource('fuel', FuelsController::class);
    // Route::get('fuel.asp', [FuelsController::class,'index'])->name('fuel.asp.index');


});


Route::middleware('auth', 'lang')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('lang/{locale}',[SetlangController::class, 'setlocalization'])->name('lang');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login/save', [AuthController::class, 'login'])->name('login.save');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';
