<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FormController;
use App\Http\Controllers\HomeController;
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
Route::get('/home', [HomeController::class, 'showHome'])->name('showHome');
Route::get('/home/{code}', [HomeController::class, 'viewForm'])->name('viewForm');
Route::post('/home/save', [HomeController::class, 'save'])->name('saveData');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::get('/login', [LoginController::class, 'showLogin']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::any('/dashboard', [DashboardController::class,'showDashboard'])->name('dashboard');
        Route::get('/logout', [LoginController::class,'logout'])->name('logout');
            //Forms
        Route::get('/forms/{id?}', [FormController::class, 'list'])->name('showForms');
        Route::post('/forms/save', [FormController::class, 'save'])->name('saveForms');
        Route::get('/forms/delete/{id}',[FormController::class, 'delete'])->name('deleteForms');
    });
});
