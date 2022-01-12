<?php

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

Route::prefix('masters')->group(function() {
    Route::get('/', 'MastersController@index');
    Route::resource('/account/group', 'AccountGroupController');
    Route::resource('/accounts/master', 'AccountMasterController');
});
