<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth.login'])->group(function () {
    Route::get('/',[AuthController::class , 'index'])->name('loginForm');
    Route::post('/authenticate',[AuthController::class , 'authLogin'])->name('authLogin');
});


Route::middleware(['auth.admin'])->group(function () {
    Route::get('logout',[AuthController::class , 'logout'])->name('logout');
    Route::prefix('admin')->group(function () {
        Route::get('/',[AdminController::class, 'index'])->name('adminDashboard');
        Route::get('/delete/{id}/{aMemberId}',[AdminController::class, 'delete'])->name('UserDelete');
    });
});