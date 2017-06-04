<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/3/26
 * Time: 下午4:22
 */

namespace App\Middleware;


class Http
{
    public function handle($response)
    {
		header('Access-Control-Allow-Origin:*');  
	    header('Access-Control-Allow-Methods:POST,PUT,GET,DELETE,OPTIONS');  
	    header('Access-Control-Allow-Headers:x-requested-with,content-type');
    	if( $_SERVER['REQUEST_METHOD']=='OPTIONS' ){
            header('http/1.1 200 OK');
		    exit();
    	}

        return $response;
    }

}