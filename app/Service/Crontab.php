<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/1
 * Time: 下午1:01
 */

namespace App\Service;


use system\Config;

/**
 * 直接操作crontab服务类
 *
 * @package App\Service
 */
class Crontab
{
    private $_cmd_start_notes = "\n# web-cron start \n";

    private $_cmd_end_notes = "\n# web-cron end \n";

    /**
     * 重启crontab服务
     */
    public static function restart()
    {
        system(Config::get('command.crontab_restart'));
    }

    /**
     * 在crontab服务创建命令
     *
     * @param $cmdList 命令列表
     * @param $runUser 运行用户
     */
    public static function create($cmdList,$runUser)
    {
        $cron   = new Crontab();
        $strCmd = implode("\n",$cmdList);
        file_put_contents($cron->getLocalhostCrontabPath($runUser),$strCmd);
    }

    public function getLocalhostCrontabPath($runUser)
    {
        return basePath('storage/crontabs/'.$runUser);
    }
}