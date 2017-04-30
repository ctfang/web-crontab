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
    private $post   = '';
    private $get    = '';

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
            // 表单参数设置
            $thisRequest->get = $_GET;unset($_GET);
            $thisRequest->post= $_POST;unset($_POST);
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
     *
     * @param $route
     */
    public function setRoute($route=null)
    {
        $this->route = $route?$route:explode('?',$_SERVER['REQUEST_URI'])[0];
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

    /**
     * @var get 的key缓存
     */
    private static $_get_value;
    /**
     * 获取get表单参数
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default=null)
    {
        if( isset(self::$_get_value[$key]) ){
            return self::$_get_value[$key];
        }

        $arrKey = explode('.',$key);
        $data   = $this->get;
        foreach ($arrKey as $temKey){
            if( isset($data[$temKey]) ){
                $data   = $data[$temKey];
            }else{
                self::$_get_value[$key] = $default;
                return $default;
            }
        }
        self::$_get_value[$key] = $data;
        return $data;
    }

    /**
     * @var post 的key缓存
     */
    private static $_post_value;
    /**
     * 获取get表单参数
     *
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function post($key, $default=null)
    {
        if( isset(self::$_post_value[$key]) ){
            return self::$_post_value[$key];
        }

        $arrKey = explode('.',$key);
        $data   = $this->post;
        foreach ($arrKey as $temKey){
            if( isset($data[$temKey]) ){
                $data   = $data[$temKey];
            }else{
                self::$_post_value[$key] = $default;
                return $default;
            }
        }
        self::$_post_value[$key] = $data;
        return $data;
    }
}