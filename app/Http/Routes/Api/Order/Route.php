<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 5/16/16
 * Time: 1:28 PM
 */

Route::group(['prefix' => 'api/v1', 'middleware' => ['jwt.auth', 'header.verify']], function () {

    Route::get('orderHistoryByMonth', 'OrderController@getOrderHistoryByMonth');
    Route::get('orderHistoryByMonth/{year}/{month}', 'OrderController@getOrderHistoryBySalesID');
    Route::get('orderHistoryBySalesID/{id}', 'OrderController@getOrderSalesDetail');
    Route::post('order', 'OrderController@store');
    Route::get('orderRecentHistory', 'OrderController@orderRecent');
    Route::get('getOrderNotification/{sales_id}', 'OrderController@getOrderNotification');

});

