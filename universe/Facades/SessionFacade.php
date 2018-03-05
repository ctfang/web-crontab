<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/12
 * Time: 17:40
 */

namespace Universe\Facades;


use Universe\App;

class SessionFacade
{
    use Facade;

    public static function getFacadeAccessor()
    {
        return App::getShared('session');
    }
}