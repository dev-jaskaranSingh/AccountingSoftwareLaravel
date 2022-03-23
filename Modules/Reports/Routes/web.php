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
Route::group(['prefix' => 'reports', 'as' => 'reports.', 'middleware' => 'admin'], function () {

    //Main Route
    Route::get('/', 'ReportsController@index');

    //Trial Balance
    Route::get('/trial-balance', 'TrailBalanceController@trailBalanceForm')->name('trial-balance');
    Route::post('/trial-balance-master-view', 'TrailBalanceController@index')->name('trial-balance-master');

    //Ledger Report
    Route::get('/ledger-report', 'ReportsController@financeLedgerForm')->name('ledger-report');
    Route::get('/ledger-report-master-view', 'ReportsController@financeLedger')->name('ledger-report-master');

});
