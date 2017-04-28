<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 上午11:56
 */

namespace system;



class Kernel
{
    /**
     * 主要执行函数
     *
     * @param $request
     * @return \Exception|Response
     */
    public function handle($request)
    {

        $response   = Response::getInstance();
        $route      = Route::get($request->getRoute());
        // 执行中间件
        $response   = $this->runMiddleware($route,$response);
        // 中间可能修改
        $route      = Route::get($request->getRoute());
        $arr        = explode('@',$route['action']);
        $controler  = "\\App\\Controller\\{$arr[0]}";
        if( class_exists($controler) && method_exists($controler  = new $controler(),$function   = $arr[1]) ){
            $response->data = $controler->$function();
        }else{
            $response->data = '需要设置404路由';
        }

        return $response;
    }

    /**
     * 执行中间件
     *
     * @param $route
     * @param $response
     * @return \Exception
     */
    public function runMiddleware($route,$response)
    {
        if(!isset($route['middleware'])){
            return $response;
        }
        foreach ($route['middleware'] as $class){
            $class      = "\\App\\Middleware\\$class";
            if(class_exists($class)){
                $middleware = new $class();
                $response   = $middleware->handle($response);
            }else{
                return new \Exception("中间件不存在");
            }
        }
        return $response;
    }

    /**
     * 应用结束执行
     *
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {

    }
}