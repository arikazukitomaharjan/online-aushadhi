<?php
/**
 * Created by PhpStorm.
 * User: sabin
 * Date: 5/20/16
 * Time: 1:18 PM
 */


Route::group(['prefix' => 'api/v1', 'middleware' => ['jwt.auth', 'header.verify']], function () {

    Route::get('test', function () {

        return 'hello';
    });
    Route::put('passwordSetting/{userid}', 'SettingController@passwordSetting');
    Route::put('profileSetting/{userid}', 'SettingController@userPersonalDetailSetting');
    Route::put('addressSetting/{userid}', 'SettingController@userAddressDetailSetting');
    Route::get('profile/{userid}', 'SettingController@profile');
    Route::get('notificationSetting/{id}', 'SettingController@notificationSetting');
});
