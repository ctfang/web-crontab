<?php
/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2017/4/28
 * Time: 17:49
 */
return [
    'make_check'=>[
        'cmd'=>'* * * * * php '.basePath('cron').' check 1>> /dev/null 2>&1',
        'file'=>'/var/spool/cron/crontabs/root',
    ],

    'crontab_restart'=>'service cron restart',
];