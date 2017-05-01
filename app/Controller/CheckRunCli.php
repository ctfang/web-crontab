<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 17:13
 */

namespace App\Controller;


use App\Models\CrontabModel;
use App\Service\CronLog;
use App\Service\Crontab;
use system\Cache;
use system\Config;

/**
 * 检查，重启
 *
 * @package App\Controller
 */
class CheckRunCli
{
    /**
     * 最后运行时间key
     *
     * @var string
     */
    public $_last_run_time_key = '_last_run_time_key';

    /**
     * 记录是否重启信号
     *
     * @var string
     */
    private $_is_restart_key = '_is_restart_key';

    private $_cmd_start_notes = "\n# web-cron start \n";

    private $_cmd_end_notes = "\n# web-cron end \n";


    /**
     * 安装执行，写入root的检查定时任务
     */
    public function make()
    {
        $cmdConfig = Config::get('command.make_check');
        // 是否已经加入root命令
        if( file_exists($cmdConfig['file']) ){
            $string    = file_get_contents($cmdConfig['file']);
            if( strpos($string,$cmdConfig['cmd']) ){
                die("cmd is exists\nyou can restart crontab service\n");
            }
        }
        // 创建方案
        $cron = new CrontabModel();
        $planName = '基础方案';
        $cron->createPlan($planName,'工具依赖的命令',true);
        $cron->createCmd('root',$planName,$cmdConfig['cmd'],'默认创建');

        die("OKOOKO");
        // 开始写入root
        $write = $this->_cmd_start_notes.$cmdConfig['cmd'].$this->_cmd_end_notes;
        if( file_exists($cmdConfig['file']) ){
            file_put_contents($cmdConfig['file'],$write,FILE_APPEND);
        }else{
            file_put_contents($cmdConfig['file'],$write,FILE_APPEND);
            system( "chmod 600 {$cmdConfig['file']}" );
        }


        // 询问是否重启crontab服务
        fwrite(STDOUT,'Confirm restart service：（y/n）');
        $if = fgets(STDIN);

        if( strpos($if,'y')!==false ){
            echo Config::get('command.crontab_restart')."\n";
            Crontab::restart();
        }else{
            echo "Restart the cron service to take effect\n";
        }

    }

    /**
     * 任务检查
     */
    public function index()
    {
        CronLog::write();
        // 记录最后运行时间
        $this->setLastTime();
        // 检查更改

        if($this->getIsRestart()){
            Crontab::restart();
        }

    }

    /**
     * 获取最后运行时间
     *
     * @return null
     */
    public function getLastTime()
    {
        return Cache::get($this->_last_run_time_key);
    }

    /**
     * 设置最后运行时间
     */
    private function setLastTime()
    {
        Cache::set($this->_last_run_time_key,time());
    }

    /**
     * 设置重启信号
     *
     * @param bool $status
     */
    public function setIsRestart($status=false)
    {
        if($status){
            // 记录已经重启
            Cache::set($this->_is_restart_key,[
                'status'=>true,// 已经重启
                'restart_time'=>time(),// 执行重启时间
            ]);
        }else{
            // 新增重启
            Cache::set($this->_is_restart_key,[
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
    public function getIsRestart()
    {
        $data = Cache::get($this->_is_restart_key);

        if( empty($data) ){
            return false;
        }elseif ($data['status'] ){
            return false;
        }

        return true;
    }
}