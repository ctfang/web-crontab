<?php
/**
 * 公开路由
 *
 * User: selden
 * Date: 2017/3/26
 * Time: 下午3:23
 */
return [
    '404'=>'PublicController@error',

    '/permission_denied'=>'PublicController@permission_denied',

    '/'=>'PublicController@index',

    '/test'=>'PublicController@test',

    '/login'=>'AuthController@login',
];