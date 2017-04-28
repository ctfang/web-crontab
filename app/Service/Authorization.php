<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 11:54
 */

namespace App\Service;


use BadMethodCallException;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use system\Config;

class Authorization
{
    private $issuer = 'web-crontab';
    public static function register()
    {
        return new Authorization();
    }

    public function getToken($userInfo)
    {
        $signer = new Sha256();

        $token  = (new Builder())->setIssuer($this->issuer)
            ->setExpiration(time()+3600*24)
            ->set('username',$userInfo['username'])
            ->set('login_time',$userInfo['login_time'])
            ->sign($signer,Config::get('jwt_key'))
            ->getToken();
        return (string)$token;
    }

    public function verify()
    {
        if(isset($_SERVER['HTTP_AUTHORIZATION'])){
            $strToken = $_SERVER['HTTP_AUTHORIZATION'];
        }elseif( isset($_COOKIE['Authorization']) ){
            $strToken = $_COOKIE['Authorization'];
        }else{
            return false;
        }
        $signer = new Sha256();
        try{
            $token = (new Parser())->parse($strToken);
            if( !$token->verify($signer,Config::get('jwt_key')) ){
                return false;
            }
        }catch (BadMethodCallException $E){
            return false;
        }
        $data = new ValidationData();
        $data->setIssuer($this->issuer);
        return $token->validate($data);
    }
}