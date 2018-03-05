<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/23
 * Time: 17:19
 */

namespace App\Http\Controllers;


use App\Models\User;

class UserController extends Controller
{
    public function editPassword()
    {
        return $this->view('/admin/user/edit_password')->render();
    }

    public function updatePassword()
    {
        $password = $this->request->post('password');
        $userId   = $this->request->getSession()->get('user.id');
        $userModel= User::find($userId);
        $password = $userModel->password($password);
        $userModel->password = $password;
        $userModel->update();
        $this->redirect('/user/edit-password');
    }
}