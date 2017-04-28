<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午1:38
 */

namespace system;
use system\Tools\Header;

/**
 * 响应类
 *
 * @package system
 */
class Response
{

    private static $_instance;

    // 设置响应信息
    public $data = '';

    public static function getInstance()
    {
        if(!isset(self::$_instance)){
            self::$_instance = new Response();
        }
        return self::$_instance;
    }

    /**
     * 输出到界面
     */
    public function send()
    {
        $data = $this->data;

        if( !empty($data) ){
            // 自动选择响应头
            if(!is_string($data) && !is_integer($data)){
                Header::json();
                $data = json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                Header::html();
            }

            echo $data;

            if (function_exists('fastcgi_finish_request')) {
                fastcgi_finish_request();
            }
        }
    }

    /**
     * 重定向
     *
     * @param $uri
     */
    public function redirect($uri)
    {
        Request::capture()->setRoute($uri);
    }
}