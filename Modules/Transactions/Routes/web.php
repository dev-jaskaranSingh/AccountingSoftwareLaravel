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

Route::group(['prefix' => 'transactions', 'as' => 'transactions.', 'middleware' => 'admin'], function () {
    Route::get('/', 'TransactionsController@index');

    //  Purchase Routes
    Route::get('purchases/print/{purchase}', 'PurchaseController@printPurchase')->name('purchases.print');
    Route::resource('/purchases', 'PurchaseController');
    Route::resource('/stock', 'StockController');
    Route::resource('/stockOut', 'StockOutController');
    Route::get('stockOut/print/{stockes}', 'StockOutController@printSaleInvoice')->name('stockOut.print');

    //  Sale Routes
    Route::get('sales/print/{sales}', 'SaleController@printSaleInvoice')->name('sales.print');
    Route::resource('/sales', 'SaleController');

    //  Receipt Routes
    Route::resource('/receipts', 'ReceiptController');

    //  Payments Routes
    Route::resource('/payments', 'PaymentController');

    //  Contra Routes
    Route::resource('/contra', 'ContraController');

    //  Journal Routes
    Route::resource('/journal', 'JournalController');

    //  Purchase Routes
    Route::resource('/purchases-return', 'PurchaseReturnController');

    //  Sale Routes
    Route::get('sales-return/print/{sales}', 'SaleReturnController@printSaleInvoice')
        ->name('sales-return.print');
    Route::resource('/sales-return', 'SaleReturnController');

});
