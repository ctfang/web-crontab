<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 17:47
 */

namespace App\Controller;


use system\Config;

class CronServiceCli
{
    public function make()
    {
        $cmdConfig = Config::get('command.make_check');
        if( file_exists($cmdConfig['file']) ){
            $string    = file_get_contents($cmdConfig['file']);
            if( strpos($string,$cmdConfig['cmd']) ){
                die("cmd is exists\n");
            }
        }

        file_put_contents($cmdConfig['file'],"\n# 这里是web-cron任务 \n".$cmdConfig['cmd'],FILE_APPEND);
        system(Config::get('command.crontab_restart'));
    }
}