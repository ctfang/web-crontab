<?php
/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2017/4/28
 * Time: 16:57
 */

return [
    // 自动化核心命令，没分钟检查
    'check'=>'CheckRunCli@index',
    // 安装初始化命令
    'init'=>'CheckRunCli@make',
    // 导出本地任务到项目管理
    'export'=>'CheckRunCli@export',

    'init:dir'=>'CheckRunCli@initDir',

    // 清空所有
    'clear'=>'CheckRunCli@clear',

    'server'=>'CheckRunCli@error',

    'test'=>'CheckRunCli@test',
];