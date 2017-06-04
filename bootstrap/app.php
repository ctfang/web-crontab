<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/25
 * Time: 下午8:09
 */
use system\Route;

$system = new \system\Main();

require_once __DIR__ . '/functions.php';

Route::baseMiddleware( \system\Config::get('middleware') );

require_once basePath('config/route.php');

$system->singleton(\system\Kernel::class);


return $system;