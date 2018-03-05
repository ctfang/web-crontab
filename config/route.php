<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/22
 * Time: 20:57
 */

use Universe\Support\Route;

/**
 * Route::get('/', 'IndexController@index');
 * Route::post('/{id:\d+}', 'IndexController@index');
 */

// 首页
Route::get('/', 'IndexController@index');
Route::get('/login', 'IndexController@loginShow');
Route::post('/login', 'IndexController@login');
Route::get('/index/logout', 'IndexController@logout');

Route::group(['prefix' => '', 'middleware' => 'admin'],function () {
    // 分类
    Route::group(['prefix' => '/admin'],function () {
        Route::get('', 'ProjectController@index');
    });

    // 分类
    Route::group(['prefix' => '/project'],function () {
        Route::get('', 'ProjectController@index');
        Route::get('/create', 'ProjectController@create');
        Route::get('/show/{id:\d+}', 'ProjectController@show');
        // 下属命令
        Route::get('/commands/{id:\d+}', 'ProjectController@commands');
        Route::post('/destroy/{id:\d+}', 'ProjectController@destroy');
        Route::post('/store', 'ProjectController@store');
        Route::post('/update/{id:\d+}', 'ProjectController@update');
        Route::get('/import/{id:\d+}', 'ProjectController@import');
    });

    // 用户信息
    Route::group(['prefix' => '/user'],function () {
        Route::get('/edit/{id:\d+}', 'UserController@edit');
        Route::get('/edit-password', 'UserController@editPassword');
        Route::post('/edit-password', 'UserController@updatePassword');
    });

    // 启用信息
    Route::group(['prefix' => '/use'],function () {
        Route::get('/index', 'UseController@index');
        Route::get('/check/{id:\d+}', 'UseController@check');
        Route::post('/push', 'UseController@push');
    });

    // 发布信息
    Route::group(['prefix' => '/publish'],function () {
        Route::get('/index', 'UseController@index');
        Route::get('/log', 'PublishLogController@index');
        Route::get('/roll_back/{id:\d+}', 'PublishLogController@rollBack');
    });

    // 命令
    Route::group(['prefix' => '/crond'],function () {
        Route::get('/index', 'CrondController@index');
        Route::get('/create/{groupId:\d+}', 'CrondController@create');
        Route::get('/edit/{id:\d+}', 'CrondController@edit');
        Route::post('/update/{id:\d+}', 'CrondController@update');
        Route::post('/save/{groupId:\d+}', 'CrondController@save');
        Route::post('/destroy/{id:\d+}', 'CrondController@destroy');
    });

    // 命令
    Route::group(['prefix' => '/env'],function () {
        Route::get('/index', 'EnvController@index');
        Route::get('', 'EnvController@index');
        Route::get('/create', 'EnvController@create');
        Route::get('/modify/{id:\d+}', 'EnvController@modify');
        Route::get('/edit/{id:\d+}', 'EnvController@edit');
        Route::get('/test/{id:\d+}', 'EnvController@test');
        Route::post('/update/{id:\d+}', 'EnvController@update');
        Route::post('/store', 'EnvController@store');
        Route::post('/destroy/{id:\d+}', 'EnvController@destroy');
        Route::post('/stopCmd', 'EnvController@stopCmd');
        Route::get('/stopCmd', 'EnvController@stopCmd');
        Route::post('/cmd/create/{envId:\d+}', 'EnvController@createCmd');
    });
});