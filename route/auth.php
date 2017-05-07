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
];