<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 6/16/16
 * Time: 10:35 AM
 */

Route::group(['prefix' => 'api/v1', ['middleware' => 'jwt.auth,header.verify']], function () {

    Route::post('uploadPrescription', 'PrescriptionController@uploadPrescription');
});