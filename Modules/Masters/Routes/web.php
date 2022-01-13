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

Route::group(['prefix' => 'masters','as' => 'master.'],function() {
    Route::get('/', 'MastersController@index');
    Route::resource('/account-groups', 'AccountGroupController');
    Route::resource('/accounts', 'AccountMasterController');
    Route::resource('/items', 'ItemMasterController');
    Route::resource('/item-groups', 'ItemMasterController');
    Route::resource('/units', 'UnitMasterController');
    Route::resource('/hsn', 'HSNMasterController');
});
