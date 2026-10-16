<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Artisan;

Route::get('/run-seeder/{secret}', function ($secret) {
    // Protect with a secret key
    if ($secret !== 'my-secret-key-123') {
        abort(403, 'Unauthorized');
    }
    // Execute the seeder with --force
    Artisan::call('db:seed', [
        '--force' => true,
    ]);
    return '<pre>' . Artisan::output() . '</pre>';
});

Route::get('/', [HomeController::class, 'someMethod']);
Route::post('/api/checkout', [HomeController::class, 'processCheckout'])->name('checkout.process');

Route::middleware('auth')->group(function () {
    //protect rout block
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboards');

    //profile-user
    Route::get('/user-profile', [UserController::class, 'profile'])->name('user.profile');

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

    // Sales History Management
    Route::get('/sales-management', [\App\Http\Controllers\SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales-management/export-csv', [\App\Http\Controllers\SaleController::class, 'exportCsv'])->name('sales.export');
    Route::get('/sales-management/{id}', [\App\Http\Controllers\SaleController::class, 'show'])->name('sales.show');
    Route::post('/sales-management/update-status/{id}', [\App\Http\Controllers\SaleController::class, 'updateStatus'])->name('sales.updateStatus');
    Route::delete('/sales-management/delete/{id}', [\App\Http\Controllers\SaleController::class, 'destroy'])->name('sales.delete');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/do_login', [App\Http\Controllers\LoginController::class, 'do_login'])->name('do_login');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');





