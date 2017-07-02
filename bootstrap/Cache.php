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
    /**
     * @param $key
     * @param $value
     * @param bool $expired
     *
     */
    public static function set($key,$value,$expired=false)
    {
        $data['data']    = $value;
        $data['expired'] = $expired ? $expired + time() : false;
        $string          = serialize($data);
        $path            = Config::get('storage') . '/data/' . $key;
        if (!is_dir(dirname($path))) {
            chmod(dirname($path),0777);
            mkdir(dirname($path), 0755, true);
            chmod($path,0777);
        }

        file_put_contents($path, $string);
    }

    /**
     * @param $key
     * @return array|null
     */
    public static function get($key)
    {
        $path     = Config::get('storage').'/data/'.$key;
        if(!file_exists($path)){
            return [];
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