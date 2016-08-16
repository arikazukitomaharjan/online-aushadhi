<?php
/**
 * Created by PhpStorm.
 * User: Sabin
 * Date: 5/5/2016
 * Time: 11:18 AM
 */

Route::group(['prefix' => 'api/v1','middleware' =>[ 'guest']], function () {

    Route::get('articles', 'ArticleController@index');

});