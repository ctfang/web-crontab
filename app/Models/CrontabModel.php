<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/1
 * Time: 下午1:23
 */

namespace App\Models;


use App\Service\Crontab;
use App\Service\Files;
use App\Service\Lists;
use system\Cache;
use system\Config;

class CrontabModel
{


    /**
     * 获取命令列表
     *
     * @param $planName
     * @return null
     */
    public function lists($planName)
    {
        return $list = Cache::get($this->getPlanListKey($planName));
    }

    /**
     * 创建命令，加入方案命令列表
     *
     * @param $runUser 运行用户
     * @param $planName 方案名称
     * @param $cmd  命令
     * @param $remake 备注
     * @return mixed 命令id
     */
    public function create($runUser,$planName,$cmd,$remake)
    {
        $data = [
            'id'=>$this->getCmdId($planName),
            'created'=>date('Y-m-d H:i:s'),
            'runUser'=>$runUser,
            'cmd'=>$cmd,
            'remake'=>$remake,
            'status'=>true,
        ];

        $list = Cache::get($this->getPlanListKey($planName));
        $list[$data['id']] = $data;
        Cache::set($this->getPlanListKey($planName),$list);
        return $data['id'];
    }

    /**
     * 生产命令id
     */
    public function getCmdId($planName)
    {
        $data = Cache::get($this->getPlanListKey($planName));
        if( empty($data) ){
            return 1;
        }
        $data = end($data);

        return $data['id']+1;
    }

    /**
     * 获取方案命令列表key
     *
     * @param $planName
     * @return string
     */
    public function getPlanListKey($planName)
    {
        return 'list_key_for_'.$planName;
    }

    /**
     * 编辑
     */
    public function edit($id,$runUser,$planName,$cmd,$remake,$status)
    {
        $data = $this->show($planName,$id);

        $runUser!==null and $data['runUser'] = $runUser;
        $cmd!==null     and $data['cmd'] = $cmd;
        $remake!==null  and $data['remake'] = $remake;
        $status!==null  and $data['status'] = $status;

        $list = Cache::get($this->getPlanListKey($planName));
        $list[$data['id']] = $data;
        Cache::set($this->getPlanListKey($planName),$list);
        return $data['id'];
    }

    /**
     * 删除
     */
    public function destroy($planName,$id)
    {
        $list = Cache::get($this->getPlanListKey($planName));
        unset($list[$id]);
        Cache::set($this->getPlanListKey($planName),$list);
        return true;
    }

    /**
     * 查询
     */
    public function show($planName,$id)
    {
        $list = Cache::get($this->getPlanListKey($planName));
        return $list[$id];
    }

    /**
     * 获取可用的配置
     */
    public function getUseList()
    {
        $userList   = [];
        $list       = (new PlanModel())->lists();
        foreach ($list as $item){
            if( $item['status'] ){
                foreach ($item['cmd-list'] as $arrCmd){
                    if( $arrCmd['status'] ){
                        $userList[$arrCmd['runUser']][] = $this->cmdDecode($arrCmd['cmd']);
                    }
                }

            }
        }
        return $userList;
    }

    /**
     * 生产系统可用的crontab命令
     *
     * @param $arrCmd
     * @return string
     */
    public function cmdDecode($arrCmd)
    {
        $cmd = $arrCmd['minute'].' '.$arrCmd['hour'].' '.$arrCmd['day'].' '.$arrCmd['month'].' '.$arrCmd['week'].' '.$arrCmd['cmd'];

        return $cmd;
    }

    /**
     * 是否安装检查的定时任务
     */
    public function hasCheck()
    {
        $check = Config::get('command.check');
        // 是否已经加入root命令
        $files      = new Files();
        $path       = Config::get('command.system_crontab_path') . '/root';
        $cronConfig = $files->get($path);
        if( strpos($cronConfig,$check)===false ){
            return false;
        }
        return true;
    }

    /**
     * 写入检查命令
     */
    public function insertCheck()
    {
        $check = Config::get('command.check');
        // 是否已经加入root命令
        $LocalModel = new LocalModel();
        $cron       = new CrontabModel();
        $PlanModel  = new PlanModel();
        $plan       = '默认安装';
        if( !$PlanModel->isHas($plan) ){
            $localPath = basePath('storage/crontabs/');
            $files     = (new Files());
            $sysLst   = $files->getFiles(Config::get('command.system_crontab_path'));
            // 复制已有的文件到
            foreach ($sysLst as $sys_path){
                $user    = pathinfo($sys_path)['filename'];
                $files->put($localPath.$user,$this->getFirstString($sys_path));
            }
            $PlanModel->create($plan, '默认安装', true);
            $arrCmd = $LocalModel->cronDecode($check);
            $cron->create('root', $plan, $arrCmd['crontab'], 'web-cron安装的命令-定时检查是否需要重启');
            // 在使用导入功能，把本地所有命令导入项目管理
            $LocalModel->exList();
        }
    }

    /**
     * 获取第一条命令之前的字符串
     *
     * @param $sys_path
     * @return array
     */
    public function getFirstString($sys_path)
    {
        $fh     = fopen($sys_path,'r');
        $string = '';
        while (!feof($fh)){
            $old_str = fgets($fh);
            $str     = trim($old_str);
            if( isset($str{0}) ){
                if( $str{0}=='*' || is_numeric($str{0}) ){
                    fclose($fh);
                    return $string;
                }
            }
            $string  = $string.$old_str;
        }
        fclose($fh);
        return $old_str?$old_str:'';
    }

    /**
     * 记录版本
     */
    public function makeRelease()
    {
        $files     = new Files();
        $system_crontab_path = Config::get('command.system_crontab_path','/var/spool/cron/crontabs');
        $savePath  = basePath('storage/release/'.date('Y-m-d').'-'.uniqid());
        $files->copyDir($system_crontab_path,$savePath);
        // 生成存储链
        $lists     = new Lists();
        $lists->put('cronRelease',[
            'path'=>$savePath,
            'tittle'=>'初始化备份',
            'date'=>date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 回滚
     *
     * @param $id
     * @param $page
     */
    public function rollback($id,$page)
    {
        $list = (new Lists())->getPage('cronRelease',$page);
        $arr  = $list[$id];
        $files= new Files();
        $files->delFiles(basePath('storage/crontabs/'));
        $files->copyDir($arr['path'],basePath('storage/crontabs/'));
    }
}