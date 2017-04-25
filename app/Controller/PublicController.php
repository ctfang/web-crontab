<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午2:06
 */

namespace App\Controller;

use App\App;
use App\Directory;
use App\Config;
use App\Output;

class PublicController
{
    public function error()
    {
        return "这里是404页面";
    }

    /**
     * @return bool|string
     */
    public function index()
    {
        return file_get_contents(basePath('public/index.html'));
    }
}