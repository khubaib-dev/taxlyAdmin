<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\COAController;
use App\Http\Controllers\CriteriaController;

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
Route::get('logout',[AuthController::class , 'logout'])->name('logout');

Route::middleware(['auth.admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[AdminController::class, 'index'])->name('adminDashboard');
        Route::get('/delete/{id}/{aMemberId}',[AdminController::class, 'delete'])->name('UserDelete');
        Route::prefix('COA')->group(function () {
            Route::get('parent/{id}',[COAController::class, 'COA'])->name('showCOA');
            Route::get('delete/{id}',[COAController::class, 'delete'])->name('deleteCOA');
            Route::post('addCOA',[COAController::class, 'addCOA'])->name('addCOA');
            Route::post('updateCOA',[COAController::class, 'updateCOA'])->name('updateCOA');
        });
        Route::prefix('criteria')->group(function () {
            Route::get('/',[CriteriaController::class, 'index'])->name('showCriteria');
            Route::get('delete/{id}',[CriteriaController::class, 'delete'])->name('deleteCriteria');
            Route::post('add',[CriteriaController::class, 'addCriteria'])->name('addCriteria');
            Route::post('update',[CriteriaController::class, 'updateCriteria'])->name('updateCriteria');
        });
    });
});