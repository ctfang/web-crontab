<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午2:47
 */


use system\Route;

/**
 * 设置路由中间件
 */


Route::middleware('auth','Auth');

/**
 * 统一整理路由
 */
Route::Arrangement();