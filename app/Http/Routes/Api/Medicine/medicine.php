<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/16/16
 * Time: 1:18 PM
 */


Route::group(['prefix' => 'api/v1', 'middleware' => ['jwt.auth', 'header.verify']], function () {

    Route::get('medicineName/{medicine_name}', 'MedicineController@autocompleteMedicine');

});