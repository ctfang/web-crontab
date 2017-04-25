<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 上午11:58
 */

namespace system;


class Main
{
    private static $bindings;
    private static $instances;

    public function singleton($abstract, $concrete = null)
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        if (! $concrete instanceof Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }

        self::$bindings[$abstract] = $concrete;

    }

    /**
     * @param  string  $abstract
     * @param  string  $concrete
     * @return \Closure
     */
    protected function getClosure($abstract, $concrete)
    {
        return function () use ($abstract, $concrete){
            $return = new $concrete;
            $return->abstract=$abstract;
            return $return;
        };
    }

    public function make($abstract)
    {
        if ( isset(self::$instances[$abstract]) ) {
            self::$instances[$abstract];
        }

        self::$instances[$abstract] = call_user_func_array(self::$bindings[$abstract],[]);
        return self::$instances[$abstract];
    }
}