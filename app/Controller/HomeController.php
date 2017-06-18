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
use App\Service\Lists;
use App\Service\Output;

class HomeController
{
    /**
     * 获取上次启用信息-时间和标示
     */
    public function getRestartinfo()
    {
        $data = Crontab::getRestartInfo();
        if( !$data ){
            //return Output::error('没有重启信息',10000);
        }
        return Output::success('获取上次启用信息-时间和标示','10001',[
            'last_id'=>date("Hi"),
            'last_check'=>time()-30,
        ]);
    }

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
        if( empty($name) || empty($remark) ){
            return Output::error('参数缺失',40004);
        }
        // 生成版本
        (new CrontabModel())->makeRelease($name,$remark);
        return Output::success('',10001,true);
    }

    /**
     * 获取版本历史
     */
    public function getReleaseList()
    {
        $page  = request()->get('page',0);
        $model = new Lists();
        $data  = $model->getPage('cronRelease',$page);
        return Output::success('获取版本历史',10001,$data);
    }
}