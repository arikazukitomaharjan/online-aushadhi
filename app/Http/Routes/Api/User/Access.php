<?php
    /**
     * Created by PhpStorm.
     * User: Sabin
     * Date: 5/4/2016
     * Time: 3:28 PM
     */

    /** @var TYPE_NAME $router */

    Route::group(['prefix' => 'api/v1' , 'middleware' => ['jwt.auth' , 'header.verify']] , function () {

        Route::get('authenticateTest' , 'AuthenticateController@routeTest');
        Route::get('logout/{device_token}' , 'AuthenticateController@logout');
        Route::get('notification/{pageNumber}' , 'AuthenticateController@notificationList');
        Route::get('notificationView/{id}' , 'AuthenticateController@notificationView');
        Route::delete('notificationDelete' , 'AuthenticateController@notificationDelete');
        Route::delete('notificationDelete/{id}' , 'AuthenticateController@notificationDeleteByID');
        Route::get('trash' , 'AuthenticateController@trash');
        Route::post('trashRestore/{id}' , 'AuthenticateController@trashRestore');
        Route::delete('trashDelete/{id}' , 'AuthenticateController@trashDelete');
        Route::get('notificationRead/{id}' , 'AuthenticateController@notificationRead');
        Route::post('notif/{device_token}' , 'AuthenticateController@notification');

    });
    Route::group(['prefix' => 'api/v1'] , function () {

        Route::post('register' , 'AuthenticateController@postRegister');
        Route::post('getJson' , 'AuthenticateController@getJson');
        Route::post('authenticate' , 'AuthenticateController@authenticate');
        Route::get('register/verify/{hash}' , 'AuthenticateController@confirm');
        Route::post('resetPassword/{email}' , ['uses' => 'AuthenticateController@forgotPassword']);
        Route::get('authenticateTests' , 'AuthenticateController@routeTests');
        Route::get('week' , 'AuthenticateController@weekTest');
//        Route::post('notificationDelivered' , 'AuthenticateController@notificationDelivered');
//
    });



        Route::post('notificationDelivered' , 'AuthenticateController@notificationDelivered');



    
