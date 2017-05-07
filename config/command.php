<?php
/**
 * 命令相关配置
 *
 * User: selden1992
 * Date: 2017/4/28
 * Time: 17:49
 */
return [
    // 安装make命令配置
    'make_check'=>[
        'cmd'=>'* * * * * php '.basePath('cron').' check >> /dev/null 2>&1',
        'file'=>'/var/spool/cron/crontabs/root',
    ],

    // 重启命令
    'crontab_restart'=>'sudo service cron restart',

    // cron命令目录
    'cron_path'=>'/usr/bin/crontab',
];