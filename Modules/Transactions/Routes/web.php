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

Route::group(['prefix' => 'transactions','as' => 'transactions.','middleware' => 'admin'],function() {
    Route::get('/', 'TransactionsController@index');

//    Purchase Routes
    Route::get('/print/{purchase}', 'PurchaseController@printPurchase')->name('purchases.print');
    Route::resource('/purchases', 'PurchaseController');
});
