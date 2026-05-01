<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [HomeController::class, 'someMethod']);

Route::middleware('auth')->group(function () {
    //protect rout block
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboards');

    Route::get('/menubar-edit/{id}',[HomeController::class,'edit']);
    Route::post('/menubar-edit/{id}', [HomeController::class, 'update']);

    Route::get('/menubar-editSlider/{id}',[HomeController::class,'editSlider']);
    Route::post('/menubar-editSlider/{id}', [HomeController::class, 'updateSlider']);

    Route::get('/menubar-editSlider2/{id}',[HomeController::class,'editSlider2']);
    Route::post('/menubar-editSlider2/{id}', [HomeController::class, 'updateSlider2']);

    Route::get('/menubar-editSlider3/{id}',[HomeController::class,'editSlider3']);
    Route::post('/menubar-editSlider3/{id}', [HomeController::class, 'updateSlider3']);

    //user manage
    Route::get('/user-management', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-management/store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user-management/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user-management/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/do_login', [App\Http\Controllers\LoginController::class, 'do_login'])->name('do_login');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');





