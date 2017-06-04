<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午4:22
 */

namespace App\Middleware;


use App\Service\Authorization;

class Auth
{
    public function handle($response)
    {
        if( Authorization::register()->verify() ){
            return $response;
        }
        $response->redirect('/permission_denied');
        return $response;
    }
}