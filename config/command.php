<?php
/**
 * 命令相关配置
 *
 * User: selden1992
 * Date: 2017/4/28
 * Time: 17:49
 */
return [
    // 检查命令
    'check'=>'* * * * * php '.basePath('cron').' check >> /dev/null 2>&1',

    // 配置文件项目维护块标识
    'set_start'=>"\n# 以下是web-cron的内容\n",
    'set_end'=>"\n# 以上是web-cron的内容\n",

    // 重启命令
    'crontab_restart'=>'service cron restart',

    // cron命令目录
    'cron_path'=>'/usr/bin/crontab',

    // 系统保存配置文件的路径
    'system_crontab_path'=>'/var/spool/cron/crontabs',
];