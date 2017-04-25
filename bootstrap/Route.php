<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午3:15
 */

namespace system;


class Route
{
    private static $_route;

    /**
     * 获取路由
     *
     * @param $uri
     * @return \Exception
     */
    public static function get($uri)
    {
        $route = self::getRoute();

        if (isset($route[$uri])){
            return $route[$uri];
        }elseif (isset($route['404'])){
            return $route['404'];
        }
        return null;
    }
    /**
     * 获取路由
     *
     * @param null $file
     * @return mixed
     */
    public static function getRoute($file=null)
    {
        if( is_null($file) ){
            return self::$_route;
        }

        $path = $file.'.php';

        if(!isset(self::$_route[$file])){
            if(file_exists( $path = basePath('route/'.$path) )){
                self::$_route[$file] = include_once $path;
            }else{
                self::$_route[$file] = [];
            }
        }
        return self::$_route[$file];
    }

    /**
     * 添加中间件
     *
     * @param $file
     * @param string $middleware
     */
    public static function middleware($file,$middleware)
    {
        self::$_route[$file] = self::getRoute($file);

        foreach (self::$_route[$file] as &$arr){
            if( !is_array($arr) ){
                $arrTemp = [];
                $arrTemp['action'] = $arr;
                $arr     = $arrTemp;
            }
            if( !is_array($middleware) ){
                $middleware = [$middleware];
            }
            foreach ($middleware as $item){
                $arr['middleware'][] = $item;
            }
        }
    }

    /**
     * 设置基础中间件
     *
     * @param $middleware
     */
    public static function baseMiddleware($middleware)
    {
        $fileList = scandir(basePath('route/'));
        foreach ($fileList as $file){
            if( !in_array($file,['.','..']) ){
                $file = strstr($file,'.php',true);
                Route::middleware($file,$middleware);
            }
        }
    }
    /**
     * 统一整理
     */
    public static function Arrangement()
    {
        $list = Route::getRoute();
        self::$_route = [];
        foreach ($list as $arr){
            self::$_route = self::$_route+$arr;
        }
    }
}