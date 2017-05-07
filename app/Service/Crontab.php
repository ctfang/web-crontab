<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/1
 * Time: 下午1:01
 */

namespace App\Service;


use App\Models\CrontabModel;
use App\Models\PlanModel;
use system\Cache;
use system\Config;

/**
 * 直接操作crontab服务类
 *
 * @package App\Service
 */
class Crontab
{
    /**
     * 记录是否重启信号
     *
     * @var string
     */
    private static $_is_restart_key = '_is_restart_key';

    private $_cmd_start_notes = "\n# web-cron start \n";

    private $_cmd_end_notes = "\n# web-cron end \n";

    /**
     * 重启crontab服务
     */
    public static function restart()
    {
        // 整合数据
        $list = (new CrontabModel())->getUseList();
        foreach ($list as $user=>$cmd){
            $str = implode("\n",$cmd)."\n ";
            file_put_contents(basePath('storage/crontabs/'.$user),$str);
        }
        die("OK");
        // 写入配置文件


        // 重启服务器
        system(Config::get('command.crontab_restart'));


        // 设置已经重启
        self::setIsRestart(false);
    }

    /**
     * 在crontab服务创建命令
     *
     * @param $cmdList 命令列表
     * @param $runUser 运行用户
     */
    public static function create($cmdList,$runUser)
    {
        $cron   = new Crontab();
        $strCmd = implode("\n",$cmdList);
        file_put_contents($cron->getLocalhostCrontabPath($runUser),$strCmd);
    }

    public function getLocalhostCrontabPath($runUser)
    {
        return basePath('storage/crontabs/'.$runUser);
    }


    /**
     * 设置重启信号
     *
     * @param bool $status
     */
    public static function setIsRestart($status=false)
    {
        if($status){
            // 记录已经重启
            Cache::set(self::$_is_restart_key,[
                'status'=>true,// 已经重启
                'restart_time'=>time(),// 执行重启时间
            ]);
        }else{
            // 新增重启
            Cache::set(self::$_is_restart_key,[
                'created'=>time(),// 信号时间
                'status'=>false,// 重启状体
                'restart_time'=>0,// 执行重启时间
            ]);
        }

    }

    /**
     * 获取是否重启信号
     *
     * @return null
     */
    public static function getIsRestart()
    {
        $data = Cache::get(self::$_is_restart_key);

        if( empty($data) ){
            return false;
        }elseif ($data['status'] ){
            return false;
        }

        return true;
    }

    /**
     * 最近的重启信息
     */
    public static function getRestartInfo()
    {
        return Cache::get(self::$_is_restart_key,[]);
    }
}