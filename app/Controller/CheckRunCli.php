<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 17:13
 */

namespace App\Controller;


use App\Service\CronLog;
use system\Cache;

class CheckRunCli
{
    public $_last_run_time_key = '_last_run_time_key';
    /**
     * 任务检查
     *
     * @param $cmd
     */
    public function index($cmd)
    {
        CronLog::write();
        // 记录最后运行时间
        Cache::set($this->_last_run_time_key,time());
        // 检查更改
    }

    public function getLastTime()
    {
        return Cache::get($this->_last_run_time_key);
    }

}