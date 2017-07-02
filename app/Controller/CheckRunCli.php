<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 17:13
 */

namespace App\Controller;


use App\Models\CrontabModel;
use App\Models\LocalModel;
use App\Service\CronLog;
use App\Service\Crontab;
use App\Service\Files;
use App\Service\Lists;
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
     * 安装执行，写入root的检查定时任务
     */
    public function make()
    {
        $cronModel = new CrontabModel();
        if( $cronModel->hasCheck() ){
            echo "sorry,cmd exists";
            die("\n");
        }
        $this->initDir();
        $cronModel->initRelease('接入系统前的备份','接入系统前的备份');
        $cronModel->insertCheck();
        echo "create check cmd\n";
        // 询问是否重启crontab服务
        fwrite(STDOUT,'Confirm restart service：（y/n）');
        $if = fgets(STDIN);

        if( strpos($if,'y')!==false ){
            echo Config::get('command.crontab_restart')."\n";
            Crontab::restart();
            $cronModel->initRelease('第一个备份','接入系统后，第一个的备份');
        }else{
            echo "Restart the cron service to take effect\n";
        }

    }

    /**
     * 清理，还原成初始版本
     */
    public function clear()
    {
        $system_crontab_path = Config::get('command.system_crontab_path','/var/spool/cron/crontabs');
        $savePath  = basePath('storage');
        $files = new Files();
        $files->delFiles($system_crontab_path);
        $files->delFiles($savePath,true);
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
        if( Crontab::getIsRestart() ){
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
     * 导出本地任务到项目管理
     */
    public function export()
    {
        (new LocalModel())->exList();
    }

    /**
     * 初始化目录
     */
    public function initDir()
    {
        $dirList = [
            basePath('storage/'),
            basePath('storage/crontabs/'),
            basePath('storage/data/'),
            basePath('storage/log/'),
            basePath('storage/release/'),
        ];
        foreach ($dirList as $dir){
            if( !is_dir($dir) ){
                mkdir($dir,0755,true);
            }
            chmod($dir,0777);
        }
    }

    /**
     * 测试命令
     */
    public function test()
    {
        file_put_contents(basePath('storage/test.log'),date('Y--d H:i:s'),FILE_APPEND);
    }
}