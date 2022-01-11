<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('/users/{user}/edit/password',[UserController::class,'editPassword'])->name('users.edit.password');
        Route::put('/users/{user}/update/password',[UserController::class,'updatePassword'])->name('users.update.password');
    });

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'loginNow'])->name('login.now');
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('/',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['middleware' => 'user.guest'], function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'loginNow'])->name('login.now');
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
