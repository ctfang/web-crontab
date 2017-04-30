<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 17:47
 */

namespace App\Controller;


use system\Config;

class CronServiceCli
{

    private $_cmd_start_notes = "\n# web-cron start \n";

    private $_cmd_end_notes = "\n# web-cron end \n";


    /**
     * 安装执行，写入root的检查定时任务
     */
    public function make()
    {
        $cmdConfig = Config::get('command.make_check');
        if( file_exists($cmdConfig['file']) ){
            $string    = file_get_contents($cmdConfig['file']);
            if( strpos($string,$cmdConfig['cmd']) ){
                die("cmd is exists\nyou can restart crontab service\n");
            }
        }
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
            system(Config::get('command.crontab_restart'));
        }else{
            echo "Restart the cron service to take effect\n";
        }

    }

}