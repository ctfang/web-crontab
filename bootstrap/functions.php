<?php

/**
 * 请求实例
 *
 * @return \system\Request
 */
function request()
{
    return \system\Request::capture();
}

/**
 * 基础路径
 *
 * @param string $path
 * @return string
 */
function basePath($path='')
{
    return dirname(__DIR__) .'/'.$path;
}

/**
 * @internal param array ...$params
 */
function p()
{
    $params = func_get_args();
    foreach ($params as $arr){
        echo '<xmp>';
        print_r($arr);
        echo '</xmp>';
    }
}