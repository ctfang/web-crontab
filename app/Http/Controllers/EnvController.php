<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/26
 * Time: 13:07
 */

namespace App\Http\Controllers;


use App\Models\Environment;
use App\Models\System;

class EnvController extends Controller
{
    /**
     * 列表
     *
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function index()
    {
        $view        = $this->view('/admin/env/list');
        $view->lists = Environment::orderBy('id', 'desc')->paginate(NULL, ['*'], 'page', $this->request->get('page'));
        return $view->render();
    }

    /**
     * 创建页面
     *
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function create()
    {
        return $this->view('/admin/env/create')->render();
    }

    /**
     * @return bool
     * @author 明月有色 <2206582181@qq.com>
     */
    public function store()
    {
        $Environment           = new Environment();
        $Environment->title    = $this->request->post('title', 'string', null, true);
        $Environment->remark   = $this->request->post('remark', 'string', '');
        $Environment->type     = $this->request->post('type', 'string');
        $Environment->host     = $this->request->post('host', 'string', null, true, true);
        $Environment->username = $this->request->post('username', 'string', '');
        $Environment->password = $this->request->post('password', 'string', '');

        if ($Environment->save()) {
            return $this->redirect('/env/index');
        }
        return $this->redirect('/env/create');
    }

    /**
     * @return bool
     * @author 明月有色 <2206582181@qq.com>
     */
    public function update($id)
    {
        $Environment           = Environment::find($id);
        $Environment->title    = $this->request->post('title', 'string', null, true);
        $Environment->remark   = $this->request->post('remark', 'string', '');
        $Environment->type     = $this->request->post('type', 'string');
        $Environment->host     = $this->request->post('host', 'string', null, true, true);
        $Environment->username = $this->request->post('username', 'string', '');
        if( $this->request->post('password', 'string', '') ){
            $Environment->password = $this->request->post('password', 'string', '');
        }
        if ($Environment->update()) {
            return $this->redirect('/env/index');
        }
        return $this->redirect('/env/edit/'.$id);
    }

    /**
     * 便捷修改定时任务
     *
     * @param $id 环境id
     * @author 明月有色 <2206582181@qq.com>
     */
    public function modify($id)
    {
        $Environment    = Environment::find($id);
        $system         = new System($Environment);
        $crontab        = $system->login ? $system->getCrontab() : [];
        $view           = $this->view('/admin/env/modify');
        $view->commands = $crontab;
        $view->envId    = $id;
        return $view->render();
    }

    /**
     * 快捷删除定时任务
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function stopCmd()
    {
        $info        = $this->request->post('strCmd');
        $envId       = $this->request->post('envId', 'int');
        $tmp         = explode('_', $info);
        $user        = $tmp[0];
        $id          = $tmp[1];
        $cmd         = implode('_', array_slice($tmp, '2'));
        $Environment = Environment::find($envId);
        $system      = new System($Environment);
        if ($system->stopCmd($user, $id, $cmd)) {
            return $this->success();
        }
        return $this->error(40005,'保存失败');
    }

    /**
     * 快捷写入定时任务
     *
     * @param int $envId
     * @author 明月有色 <2206582181@qq.com>
     */
    public function createCmd($envId)
    {
        $Environment      = Environment::find($envId);
        $system           = new System($Environment);
        $sysUser          = $this->request->post('sysUser', 'string', null, true);
        $title            = $this->request->post('title', 'string', null, true);
        $run_time         = $this->request->post('run_time');
        $arrCmd['minute'] = !$run_time['minute'] ? $run_time['minute'] : '*';
        $arrCmd['hour']   = !$run_time['hour'] ? $run_time['hour'] : '*';
        $arrCmd['day']    = !$run_time['day'] ? $run_time['day'] : '*';
        $arrCmd['month']  = !$run_time['month'] ? $run_time['month'] : '*';
        $arrCmd['week']   = !$run_time['week'] ? $run_time['week'] : '*';
        $arrCmd           = [
            'title'    => $title,
            "run_time" => implode(' ', $arrCmd),
            "command"  => $this->request->post('command')
        ];
        if ($system->login) {
            $system->createCmd($sysUser, $arrCmd);
        }
        $this->redirect('/env/modify/' . $envId);
    }

    /**
     * 编辑页面
     *
     * @param $id
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function edit($id)
    {
        $Environment = Environment::find($id);
        $view        = $this->view('/admin/env/edit');
        $view->env = $Environment;
        return $view->render();
    }

    /**
     * 测试链接
     *
     * @param $id
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function test($id)
    {
        $Environment = Environment::find($id);
        try{
            new System($Environment);
            return $this->success();
        }catch (\Exception $exception){
            return $this->error(40006,'链接失败'.$exception->getMessage());
        }
    }

    /**
     * 删除记录
     *
     * @param $id
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function destroy($id)
    {
        Environment::destroy($id);
        return $this->success();
    }
}