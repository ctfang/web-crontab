<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/26
 * Time: 11:42
 */

namespace App\Http\Controllers;


use App\Models\CrontabGroup;
use App\Models\CrontabGroupEnv;
use App\Models\Crontabs;
use App\Models\Environment;
use App\Models\PublishLog;
use App\Models\PublishVersion;
use App\Models\System;

class UseController extends Controller
{
    public function index()
    {
        $view            = $this->view('/admin/use/index');
        $view->TestEnv   = [];
        $view->RcEnv     = [];
        $view->StableEnv = [];
        $data            = CrontabGroup::where('status', 1)->get();
        foreach ($data as $datum) {
            switch ($datum->type) {
                case 1:
                    $view->TestEnv[] = $datum;
                    break;
                case 2:
                    $view->RcEnv[] = $datum;
                    break;
                case 3:
                    $view->StableEnv[] = $datum;
                    break;
            }
        }
        return $view->render();
    }

    /**
     * 发布前检查
     *
     * @author 明月有色 <2206582181@qq.com>
     * @param $id
     */
    public function check($id)
    {
        $view           = $this->view('/admin/use/check');
        $view->group    = CrontabGroup::find($id);
        $view->commands = Crontabs::where('group_id', '=', $id)->orderBy('id', 'desc')->get();
        return $view->render();
    }

    /**
     * 上线
     *
     * @author 明月有色 <2206582181@qq.com>
     * @return bool
     */
    public function push()
    {
        $id       = $this->request->post('project','int');
        $commands = Crontabs::where('group_id', $id)->orderBy('id', 'desc')->get();
        foreach ($commands as $command) {
            $command->run_time = implode(' ', json_decode($command->run_time, true));
        }
        $envList = CrontabGroupEnv::where('group_id', $id)->get();
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
        $PublishLog         = new PublishLog();
        $PublishLog->title  = $this->request->post('title', 'string', '');
        $PublishLog->status = $this->request->post('status', 'int', '0');
        $PublishLog->author = $this->request->getSession()->get('user.id');
        $PublishLog->group_id = $id;
        $PublishLog->save();
        // 当前版本所有命令保存副本
        $install = [];
        foreach ($commands as $command) {
            $install[] = [
                'log_id'=>$PublishLog->id,
                'author'=>$PublishLog->author,
                'sys_user'=>$command->sys_user,
                'run_time'=>$command->run_time,
                'command'=>$command->command,
            ];
        }
        $PublishVersion = new PublishVersion();
        $PublishVersion::insert($install);
        return $this->success();
    }
}