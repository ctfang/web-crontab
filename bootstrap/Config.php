<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午4:55
 */

namespace system;


class Config
{
    private static $_config;

    public static function get($key,$default=null)
    {
        $arr        = explode('.',$key);
        /**
         * 获取文件路径
         */
        if( count($arr)>1 ){
            if( isset(self::$_config[$arr[0]]) ){
                // 已经设置的
                $data   = self::$_config[$arr[0]];unset($arr[0]);
            }elseif ( file_exists( $filePath = basePath("config/{$arr[0]}.php") ) ){
                // 找到文件
                $data   = self::$_config[$arr[0]] = include $filePath;unset($arr[0]);
            }else{
                goto default_config;
            }
        }else{
            default_config:
            // 默认配置文件
            if( !isset(self::$_config['config']) ){
                $filePath = basePath("config/config.php");
                $data   = self::$_config['config'] = include $filePath;
            }else{
                $data   = self::$_config['config'];
            }
        }
        foreach ($arr as $key){
            if(isset($data[$key])){
                $data = $data[$key];
            }else{
                return $default;
            }
        }
        return $data;
    }
}