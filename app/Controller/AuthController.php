<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 10:52
 */

namespace App\Controller;


use App\Service\Authorization;
use App\Service\Output;
use system\Config;

/**
 * 权限控制器
 *
 * @package App\Controller
 */
class AuthController
{
    public function login()
    {
        $username = request()->post('username');
        $password = request()->post('password');

        if( $username!==Config::get('user_info.username') ){
            // 账号密码错误
            return Output::error('账号错误','40001');
        }elseif( !password_verify($password,Config::get('user_info.password')) ){
            return Output::error('密码错误','40001');
        }
        $login = [
            'username'=>$username,
            'login_time'=>time()
        ];
        $token = Authorization::register();
        return Output::success('OK','10001',[
            'Authorization'=>$token->getToken($login),
        ]);
    }

}