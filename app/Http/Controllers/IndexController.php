<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/1/23
 * Time: 10:52
 */

namespace App\Http\Controllers;


use App\Models\User;

class IndexController extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        $session = $this->request->getSession();

        if( $session->get('login',false) ){
            $this->redirect('/env/index');
        }else{
            return $this->view('welcome')->render();
        }
    }

    /**
     * loginShow
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function loginShow()
    {
        $view = $this->view('login');

        return $view->render();
    }

    public function login()
    {
        $request  = $this->request;
        $email    = $request->post('email', 'email', null, true);
        $password = $request->post('password', 'string', null, true);
        $userInfo = User::where('email','=',$email)->first();
        if( !$userInfo ){
            return [
                'code'=>40004,
                'msg'=>'用户不存在',
                'data'=>[],
            ];
        }
        if( (new User())->password($password)!=$userInfo->password ){
            return [
                'code'=>40005,
                'msg'=>'密码不正确',
                'data'=>[md5($password)],
            ];
        }
        $session = $this->request->getSession();

        $session->put('login',true);
        $session->put('user',$userInfo->toArray());

        $this->redirect('/env/index');
    }

    /**
     * 退出登录
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function logout()
    {
        $session = $this->request->getSession();
        $session->flush();
        $this->redirect('/');
    }
}