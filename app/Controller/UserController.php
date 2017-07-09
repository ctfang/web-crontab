<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/7/9
 * Time: 下午2:07
 */

namespace App\Controller;


use App\Service\Output;
use system\Config;

class UserController
{
    /**
     * 修改密码
     *
     * @return array
     */
    public function editPassword()
    {
        $check_password = request()->post('check_password');
        $password       = request()->post('password');
        if ($password != $check_password) {
            return Output::error('密码不正确', 50002);
        } elseif (is_writable($path = basePath('config/user_info.php'))) {
            $oldPassword = Config::get('user_info.password');
            $oldString   = file_get_contents($path);
            $newstring   = str_replace($oldPassword, password_hash($password, PASSWORD_DEFAULT), $oldString);
            file_put_contents($path, $newstring);
            return Output::success();
        }
        return Output::error($path.'不可些', 50001);
    }
}