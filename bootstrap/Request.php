<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午12:07
 */

namespace system;

/**
 * 请求处理类
 *
 * @package system
 */
class Request
{
    private static $init ;

    private $uri    = '';// 地址
    private $route  = '';

    /**
     * 创建单例
     *
     * @return Request
     */
    public static function capture()
    {
        if( !isset(self::$init) ){
            $thisRequest = new Request();
            $thisRequest->setUri();
            $thisRequest->setRoute();
            self::$init = $thisRequest;
        }

        return self::$init;
    }


    /**
     * 设置uri
     */
    protected function setUri()
    {
        $pageURL = 'http';

        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
            $pageURL .= "s";
        }

        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80"){
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }else{
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        $this->uri = $pageURL;
    }

    /**
     * 设置请求旅游
     */
    protected function setRoute()
    {
        $this->route = explode('?',$_SERVER['REQUEST_URI'])[0];
    }

    public function getRoute()
    {
        return $this->route;
    }

    /**
     * 获取完整uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}