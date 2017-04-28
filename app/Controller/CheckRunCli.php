<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 17:13
 */

namespace App\Controller;


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
        // 记录最后运行时间
        Cache::set($this->_last_run_time_key,time());
    }
}