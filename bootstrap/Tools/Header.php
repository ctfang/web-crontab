<?php
/**
 * Created by PhpStorm.
 * User: selden
 * Date: 2017/4/25
 * Time: 9:57
 */

namespace system\Tools;


class Header
{
    public static function json()
    {
        header('Content-Type: application/json; charset=utf-8');
    }

    public static function html()
    {
        header('content-Type: text/html; charset=utf-8');
    }
}