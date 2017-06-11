<?php
/**
 * 登陆后路由
 *
 * User: selden
 * Date: 2017/3/26
 * Time: 下午3:23
 */
return [
    // 新增方案
    '/plan/store'=>'PlanController@store',

    // 方案列表
    '/plan/list'=>'PlanController@index',

    // 方案详情
    '/plan'=>'PlanController@show',

    // 新增命令
    '/cron/store'=>'CrontabController@store',

    // 删除命令
    '/cron/destroy'=>'CrontabController@destroy',

    // 删除方案
    '/plan/destroy'=>'PlanController@destroy',

    // 编辑命令
    '/cron/edit'=>'CrontabController@edit',

    // 编辑方案
    '/plan/edit'=>'PlanController@edit',

    // 命令详情
    '/cron/show'=>'CrontabController@show',

    // 设置启动信息
    '/server/enable'=>'HomeController@enable',

    // 查看启动是否生效
    '/server/restart'=>'HomeController@is_restart',

    // 获取生效时间
    '/server/time'=>'HomeController@getRestartTime',

    // 检查命令-所有命令
    '/cron/list'=>'CrontabController@index',

    // 确认命令-生成版本
    '/cron/make/release'=>'HomeController@makeRelease',

    // 获取上次启用信息-时间和标示
    '/cron/restart/info'=>'HomeController@getRestartinfo',
];