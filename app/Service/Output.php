<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 11:40
 */

namespace App\Service;


class Output
{
    public static function success($tip='执行成功',$code=10000,$arrData=array())
    {
        return [
            'apiTip'=>$tip,
            'statusCode'=>$code,
            'arrData'=>$arrData
        ];
    }

    public static function error($tip='系统错误',$code=40000,$arrData=array())
    {
        return [
            'apiTip'=>$tip,
            'statusCode'=>$code,
            'arrData'=>$arrData
        ];
    }
}