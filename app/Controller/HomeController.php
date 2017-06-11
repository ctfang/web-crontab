<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 15:22
 */

namespace App\Controller;


use App\Models\CrontabModel;
use App\Service\Crontab;
use App\Service\Output;

class HomeController
{
    /**
     * 获取多少秒后重启
     */
    public function getRestartTime()
    {
        $lastTime = (new CheckRunCli())->getLastTime();

        $time = is_numeric($lastTime)?(time()-$lastTime):60;
        return Output::success('获取多少秒后重启',10001,$time);
    }

    /**
     * 使设置生效-启用
     * @return string
     */
    public function enable()
    {
        if( request()->get('enable',0)==0 ){
            Crontab::setIsRestart(false);
        }else{
            Crontab::setIsRestart(true);
        }
        return Output::success('使设置生效');
    }

    /**
     * 是否重启完成
     */
    public function is_restart()
    {
        if (Crontab::getIsRestart() ){
            // 启动已经生效
            return Output::success('',10001,false);
        }
        // 还没有完成重启
        return Output::success('',10001,true);
    }

    /**
     * 确认启用命令
     */
    public function makeRelease()
    {
        $name   = request()->post('name');
        $remark = request()->post('remark');
        // 生成版本
        (new CrontabModel())->makeRelease($name,$remark);
        return Output::success('',10001,true);
    }
}