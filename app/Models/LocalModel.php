<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/5/16
 * Time: 18:54
 */

namespace App\Models;
use system\Config;

/**
 * 本地cron文件解析
 *
 * @package App\Models
 */
class LocalModel
{
    /**
     * 获取已经存在的cron配置文件地址
     */
    public function getFiles()
    {
        $path = Config::get('command.system_crontab_path','/var/spool/cron/crontabs');
        if( !file_exists($path) ){
            return [];
        }
        $dir  = scandir($path);
        if( empty($dir) ) return [];
        $return = [];
        foreach ($dir as &$name){
            if( !in_array($name,['.','..']) ){
                $return[$name] = $path.'/'.$name;
            }
        }
        return $return;
    }

    /**
     * 本地cron导入项目
     */
    public function exList()
    {
        $files = $this->getFiles();
        $plan  = '导出的命令';
        (new PlanModel())->create($plan,'系统已存在的命令',true);
        $cron  = new CrontabModel();
        foreach ($files as $user=>$file){
            $cmdList = $this->readCron($file);
            foreach ($cmdList as $cmd){
                $arrCmd = $this->cronDecode($cmd);
                $cron->create($user,$plan,$arrCmd['crontab'],'导出命令');
            }
        }
    }

    /**
     * 格式成项目保存格式
     *
     * @param $cmd
     * @return mixed
     */
    public function cronDecode($cmd)
    {
        $arr = explode(' ',$cmd);
        $data['crontab']['minute'] = $arr[0];
        $data['crontab']['hour'] = $arr[1];
        $data['crontab']['day'] = $arr[2];
        $data['crontab']['month'] = $arr[3];
        $data['crontab']['week'] = $arr[4];

        $data['crontab']['cmd'] = str_replace("$arr[0] $arr[1] $arr[2] $arr[3] $arr[4] ",'',$cmd);
        return $data;
    }

    /**
     * 按cron保存格式读取每行
     *
     * @param $file 路径
     * @return array
     */
    public function readCron($file)
    {
        $list   = [];
        $fh     = fopen($file,'r');
        while (!feof($fh)){
            $str = fgets($fh);
            $str = trim($str);
            if( isset($str{0}) ){
                if( $str{0}=='*' || is_numeric($str{0}) ){
                    $list[] = $str;
                }
            }
        }
        fclose($fh);
        return $list;
    }
}