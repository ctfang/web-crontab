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
use App\Service\Output;

class PublicController
{
    /**
     * 没有设置路由
     *
     * @return string
     */
    public function error()
    {
        return "这里是404页面";
    }

    /**
     * 没有权限
     *
     * @return array
     */
    public function permission_denied()
    {
        return Output::error('permission denied','40002');
    }

    /**
     * @return bool|string
     */
    public function index()
    {
        return file_get_contents(basePath('public/index.html'));
    }
}