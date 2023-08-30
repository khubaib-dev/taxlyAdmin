<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\COAController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\OnBoardingController;

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
        Route::prefix('profile')->group(function () {
            Route::get('/',[ProfileController::class, 'index'])->name('showProfile');
            Route::post('/update',[ProfileController::class, 'update'])->name('updateProfile');
        });
        Route::get('/',[AdminController::class, 'index'])->name('adminDashboard');
        Route::get('/settings/{id}',[AdminController::class, 'settings'])->name('userSetting');
        Route::get('/transactions/{id}',[AdminController::class, 'transactions'])->name('userTransactions');
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
        Route::prefix('occupation')->group(function () {
            Route::get('/',[OccupationController::class, 'index'])->name('showOccupation');
            Route::get('delete/{id}',[OccupationController::class, 'delete'])->name('deleteOccupation');
            Route::post('store',[OccupationController::class, 'store'])->name('addOccupation');
            Route::post('update',[OccupationController::class, 'update'])->name('updateOccupation');
        });
        Route::prefix('profession')->group(function () {
            Route::get('/',[ProfessionController::class, 'index'])->name('showProfession');
            Route::get('delete/{id}',[ProfessionController::class, 'delete'])->name('deleteProfession');
            Route::post('store',[ProfessionController::class, 'store'])->name('addProfession');
            Route::post('update',[ProfessionController::class, 'update'])->name('updateProfession');
        });
        Route::prefix('userType')->group(function () {
            Route::get('/',[UserTypeController::class, 'index'])->name('showUserType');
            Route::get('delete/{id}',[UserTypeController::class, 'delete'])->name('deleteUserType');
            Route::post('store',[UserTypeController::class, 'store'])->name('addUserType');
            Route::post('update',[UserTypeController::class, 'update'])->name('updateUserType');
        });
        Route::prefix('onBoarding')->group(function () {
            Route::get('/',[OnBoardingController::class, 'index'])->name('showOnBoarding');
            Route::get('/getProfession',[OnBoardingController::class, 'getProfession'])->name('getProfession');
            Route::get('delete/{id}',[OnBoardingController::class, 'delete'])->name('deleteOnBoarding');
            Route::post('store',[OnBoardingController::class, 'store'])->name('addOnBoarding');
            Route::post('update',[OnBoardingController::class, 'update'])->name('updateOnBoarding');
        });
    });
});