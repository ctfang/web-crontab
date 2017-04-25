<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/27
 * Time: 下午1:15
 */

namespace system;


class Cache
{
    public static function set($key,$value,$expired=false)
    {
        $data['data']     = $value;
        $data['expired']  = $expired?$expired+time():false;
        $string   = serialize($data);
        $cacheDir = Config::get('storage').'/data/';
        if( !is_dir($cacheDir) ){
            mkdir($cacheDir,0755,true);
        }
        $path     = $cacheDir.$key;

        file_put_contents($path,$string);
    }

    public static function get($key)
    {
        $path     = Config::get('storage').'/data/'.$key;
        if(!file_exists($path)){
            return null;
        }
        $data     = unserialize( @file_get_contents($path) );

        if($data['expired']===false){
            return $data['data'];
        }elseif(($data['expired']-time())>0){
            return $data['data'];
        }else{
            @unlink($path);
        }
        return null;
    }
}