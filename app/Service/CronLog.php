<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/1
 * Time: 上午12:08
 */

namespace App\Service;


class CronLog
{
    public static function write()
    {
        $path = basePath('storage/log/'.date('Y-m').'.log');

        if (!is_dir(dirname($path))){
            mkdir(dirname($path),0777,true);
        }

        file_put_contents($path,date('Y-m-d H:i:s')."\n",FILE_APPEND);
    }
}