<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/3/1
 * Time: 16:13
 */

namespace App\Http\Controllers;


use App\Models\CrontabGroup;
use App\Models\CrontabGroupEnv;
use App\Models\Crontabs;
use App\Models\Environment;
use App\Models\PublishLog;
use App\Models\PublishVersion;
use App\Models\System;

class PublishLogController extends Controller
{
    /**
     * 发布版本列表
     *
     * @return mixed
     * @author 明月有色 <2206582181@qq.com>
     */
    public function index()
    {
        $view         = $this->view('/admin/version/index');
        $view->lists = PublishLog::orderBy('id','desc')->paginate(NULL, ['*'], 'page', $this->request->get('page'));
        $view->lists->setPath('/publish/log');
        return $view->render();
    }

    public function rollBack($id)
    {
        $commands = PublishVersion::where('log_id', $id)->get();
        $log     = PublishLog::find($id);
        $envList = CrontabGroupEnv::where('group_id', $log->group_id)->get();
        foreach ($envList as $env) {
            $env = Environment::find($env->env_id);
            if ($env) {
                if( $commands ){
                    (new System($env))->push($commands);
                }else{
                    (new System($env))->clear();
                }
            }
        }
        // 发布完成，写版本日记
        $PublishLog         =  PublishLog::find($id);
        $PublishLog->title  = $PublishLog->title."-回滚";
        $PublishLog->status = $PublishLog->status+1;
        $newLog = $PublishLog->toArray();
        unset($newLog['id']);
        $logId = $PublishLog->insertGetId($newLog);
        // 当前版本所有命令保存副本
        $install = [];
        foreach ($commands as $command) {
            $install[] = [
                'log_id'=>$logId,
                'author'=>$this->request->getSession()->get('user.id'),
                'sys_user'=>$command->sys_user,
                'run_time'=>$command->run_time,
                'command'=>$command->command,
            ];
        }
        $PublishVersion = new PublishVersion();
        $PublishVersion::insert($install);
        return $this->redirect('/publish/log');
    }
}