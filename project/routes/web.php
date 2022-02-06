<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\General\GeneralController;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\isLogout;
use Illuminate\Support\Facades\Route;

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

Route::middleware([isLogin::class])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginAttempt'])->name('loginAttempt');
});

Route::middleware([isLogout::class])->group(function () {
    Route::get('/', [GeneralController::class, "index"])->name('index');
    Route::get('/own-projects', [GeneralController::class, "ownProjectIndex"])->name('own');
    Route::get('/view/{id}/investors', [GeneralController::class, "InvestorsIndex"])->name('viewInvestors');
    Route::get('/logout', [LoginController::class, "logout"])->name('logout');
    Route::post("/project/view", [GeneralController::class, "getProject"]);
    Route::post("/project/invest", [GeneralController::class, "Invest"])->name("Invest");
});
