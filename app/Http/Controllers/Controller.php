<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/23
 * Time: 10:52
 */

namespace App\Http\Controllers;


use Universe\App;

class Controller extends \Universe\Support\Controller
{
    public function success()
    {
        return [
            'code' => 0,
            'msg'  => 'ok',
            'data' => []
        ];
    }

    public function error($code,$msg,$data=[])
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];
    }

    public function view($file)
    {
        $view = view($file);
        $view->request = $this->request;

        // 顶部菜单
        $uri = $view->request->getUri();
        $temp = explode('/',$uri);
        $view->active = $temp[1]??'project';
        return $view;
    }
}