<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/22
 * Time: 18:07
 */

namespace App\Http\Controllers;


use App\Models\CrontabGroup;
use App\Models\CrontabGroupEnv;
use App\Models\Crontabs;
use App\Models\Environment;
use App\Models\System;

class ProjectController extends Controller
{
    /**
     * 列表
     *
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function index()
    {
        $view         = $this->view('/admin/project/home');
        $view->groups = CrontabGroup::orderBy('id', 'desc')->paginate(NULL, ['*'], 'page', $this->request->get('page'));
        $view->groups->setPath('/admin');
        return $view->render();
    }

    /**
     * 导入关联服务的所有定时任务
     *
     * @param $id
     * @author 明月有色 <2206582181@qq.com>
     */
    public function import($id)
    {
        $envList = CrontabGroupEnv::where('group_id', $id)->get();
        foreach ($envList as $env) {
            $env = Environment::find($env->env_id);
            if ($env) {
                $crontab = (new System($env))->getCrontab();
                $insert  = [];
                foreach ($crontab as $value) {
                    $runTime          = explode(' ', $value->run_time);
                    $arrCmd['minute'] = $runTime['0'];
                    $arrCmd['hour']   = $runTime['1'];
                    $arrCmd['day']    = $runTime['2'];
                    $arrCmd['month']  = $runTime['3'];
                    $arrCmd['week']   = $runTime['4'];
                    $insert[]         = [
                        "group_id" => $id,
                        "title"    => $value->title,
                        "sys_user" => $value->sys_user,
                        "status"   => 1,
                        "author"   => $value->title,
                        "run_time" => json_encode($arrCmd),
                        "command"  => $value->command,
                    ];
                }
                if ($insert) {
                    Crontabs::insert($insert);
                }
            }
        }
    }

    /**
     * 展示创建页面
     *
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function create()
    {
        $view           = $this->view('/admin/project/create_crontab_group');
        $envs           = Environment::get();
        $view->envGroup = [];
        foreach ($envs as $env) {
            $view->envGroup[$env->type][] = $env;
        }
        return $view->render();
    }

    /**
     * 保存提交
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function store()
    {
        $CrontabGroup         = new CrontabGroup();
        $CrontabGroup->title  = $this->request->post('title', 'string', null, true);
        $CrontabGroup->remark = $this->request->post('remark', 'string', '');
        $CrontabGroup->status = $this->request->post('status', 'int', 1);
        $CrontabGroup->author = $this->request->getSession()->get('user.id');
        $CrontabGroup->type   = $this->request->post('type', 'int', 1);
        if (!$CrontabGroup->save()) {
            return $this->redirect('/create');
        }
        $CrontabGroupEnv = new CrontabGroupEnv();
        foreach ($this->request->post('hosts') as $host) {
            $CrontabGroupEnv->insert([
                                         'env_id'   => $host,
                                         'group_id' => $CrontabGroup->id
                                     ]);
        }
        return $this->redirect('/project');
    }

    /**
     * 展示详情
     *
     * @param $id
     * @author 明月有色 <2206582181@qq.com>
     */
    public function show($id)
    {
        $view           = $this->view('/admin/project/show_group');
        $envs           = Environment::select(['environment.*', 'crontab_group_env.env_id AS checked'])
            ->leftJoin('crontab_group_env',
                function ($leftJoin) use ($id) {
                    $leftJoin->on('crontab_group_env.env_id', '=', 'environment.id')
                        ->where('crontab_group_env.group_id', $id);
                })
            ->groupBy(['environment.id'])
            ->get();
        $view->envGroup = [];
        foreach ($envs as $env) {
            $view->envGroup[$env->type][] = $env;
        }
        $view->group = CrontabGroup::find($id);
        return $view->render();
    }

    /**
     * 编辑
     *
     * @param $id
     * @author 明月有色 <2206582181@qq.com>
     */
    public function commands($id)
    {
        $view           = $this->view('/admin/project/edit_group');
        $view->group    = CrontabGroup::find($id);
        $view->commands = Crontabs::where('group_id', '=', $id)->orderBy('id', 'desc')->get();
        return $view->render();
    }

    /**
     * 保存编辑
     *
     * @author 明月有色 <2206582181@qq.com>
     */
    public function update($id)
    {
        $CrontabGroup         = CrontabGroup::find($id);
        $CrontabGroup->title  = $this->request->post('title', 'string', null, true);
        $CrontabGroup->remark = $this->request->post('remark', 'string', '');
        $CrontabGroup->status = $this->request->post('status', 'int', 1);
        $CrontabGroup->type   = $this->request->post('type', 'int', 1);
        $CrontabGroupEnv      = new CrontabGroupEnv();
        $CrontabGroupEnv->where('group_id', $id)->delete();
        foreach ($this->request->post('hosts') as $host) {
            $CrontabGroupEnv->insert([
                                         'env_id'   => $host,
                                         'group_id' => $id
                                     ]);
        }
        if ($CrontabGroup->update()) {
            return $this->redirect('/project');
        }
        return $this->redirect('/project/edit/' . $id);
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
        CrontabGroup::destroy($id);
        Crontabs::where(['group_id' => $id])->delete();
        return $this->success();
    }
}