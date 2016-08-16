<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    Route::get('/' , function () {

        return view('welcome');
    });
    Route::get('/test' , function () {

        return 'test';
    });
    Event::listen('illuminate.query' , function ($query , $params , $time , $conn) {

        dd([$query , $params , $time , $conn]);
    });

    $router->group(['namespace' => 'Api\User'] , function () use ($router) {

        require(__DIR__ . '/Routes/Api/User/Access.php');

    });

    $router->group(['namespace' => 'Api\Order'] , function () use ($router) {

        require(__DIR__ . '/Routes/Api/Order/Route.php');
    });
    $router->group(['namespace' => 'Api\Prescription'] , function () use ($router) {

        require(__DIR__ . '/Routes/Api/Prescription/Prescription.php');
    });

    $router->group(['namespace' => 'Api\Setting'] , function () use ($router) {

        require(__DIR__ . '/Routes/Api/Setting/Route.php');
    });

    $router->group(['namespace' => 'Api\Medicine'] , function () use ($router) {

        require(__DIR__ . '/Routes/Api/Medicine/medicine.php');
    });


    //Route::get('register/verify/{hash}','Routes\Api\User\AuthenticateController@confirm');