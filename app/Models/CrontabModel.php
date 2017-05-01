<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/1
 * Time: 下午1:23
 */

namespace App\Models;


use system\Cache;

class CrontabModel
{
    private $_plan_list_key = '_plan_list_key';

    /**
     * 新增方案
     *
     * @param $name
     * @param $remake 备注
     * @param bool $status
     */
    public function createPlan($name,$remake,$status=false)
    {
        $data = [
            'created'=>time(),
            'name'=>$name,
            'remake'=>$remake,
            'status'=>$status,
        ];

        $list = Cache::get($this->_plan_list_key,[]);
        $list[$name] = $data;
        Cache::set($this->_plan_list_key,$list);
    }

    /**
     * 获取方案列表
     *
     * @return null
     */
    public function getPlanList()
    {
        return $list = Cache::get($this->_plan_list_key,[]);
    }

    /**
     * 获取命令列表
     *
     * @param $planName
     * @return null
     */
    public function getCmdList($planName)
    {
        return $list = Cache::get($this->getPlanListKey($planName));
    }

    /**
     * 获取可使用的命令
     */
    public function getUseList()
    {
        $userList = [];
        $plan = $this->getPlanList();

        foreach ($plan as &$item){
            if( $item['status'] ){
                $temp = $this->getCmdList($item['name']);
                foreach ($temp as $value){
                    if( $value['status'] ){
                        $userList[$value['runUser']][] = $value['cmd'];
                    }
                }

            }
        }

        return $userList;
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
    public function createCmd($runUser,$planName,$cmd,$remake)
    {
        $data = [
            'id'=>$this->getCmdId($planName),
            'created'=>time(),
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
        return '_list_key_for_'.$planName;
    }
}