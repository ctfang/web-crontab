<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/24
 * Time: 15:17
 */

namespace App\Http\Controllers;


use App\Models\CrontabGroup;
use App\Models\Crontabs;
use App\Models\System;

class CrondController extends Controller
{
    /**
     * 创建页面展示
     *
     * @param $groupId
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function create($groupId)
    {
        $view          = $this->view('/admin/crond/create');
        $view->group   = CrontabGroup::find($groupId);
        return $view->render();
    }

    /**
     * 保存提交
     *
     * @param $groupId
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function save($groupId)
    {
        $cronModel           = new Crontabs();
        $cronModel->group_id = $groupId;
        $cronModel->title    = $this->request->post('title', 'string', null, true);
        $cronModel->sys_user = $this->request->post('sysUser', 'string', null, true);
        $cronModel->status   = $this->request->post('status', 'int', 1);
        $cronModel->author   = $this->request->getSession()->get('user.id');
        $cronModel->run_time = json_encode($this->request->post('run_time'));
        $cronModel->command  = $this->request->post('command');
        if ($cronModel->save()) {
            return $this->redirect('/project/commands/' . $groupId);
        }
        return $this->error(40005,'保存失败');
    }

    /**
     * 保存提交
     *
     * @param $id
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function edit($id)
    {
        $view                    = $this->view('/admin/crond/edit');
        $view->command           = Crontabs::find($id);
        $view->command->run_time = json_decode($view->command->run_time);
        return $view->render();
    }

    /**
     * 保存提交
     *
     * @param $id
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function update($id)
    {
        $cronModel           = Crontabs::find($id);
        $cronModel->title    = $this->request->post('title', 'string', null, true);
        $cronModel->sys_user = $this->request->post('sysUser', 'string', null, true);
        $cronModel->status   = $this->request->post('status', 'int', 1);
        $cronModel->author   = $this->request->getSession()->get('user.id');
        $cronModel->run_time = json_encode($this->request->post('run_time'));
        $cronModel->command  = $this->request->post('command');
        if ($cronModel->update()) {
            return $this->redirect('/project/commands/' . $cronModel->group_id);
        }
        return $this->error(40005,'保存失败');
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
        Crontabs::destroy($id);
        return $this->success();
    }
}