<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/25
 * Time: 下午7:44
 */
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('date.timezone','Asia/Shanghai');

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(\system\Kernel::class);

$response = $kernel->handle(
    $request = \system\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);