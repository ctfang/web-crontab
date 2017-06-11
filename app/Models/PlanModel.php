<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/7
 * Time: 下午1:58
 */

namespace App\Models;

use system\Cache;

class PlanModel
{
    /**
     * 列表
     */
    public function lists()
    {
        $list = Cache::get(PlanModel::getListkey(),[]);
        $cron = new CrontabModel();
        foreach ($list as &$value){
            $value['cmd-list'] = $cron->lists($value['name']);
        }
        return $list;
    }

    /**
     * 创建
     *
     * @param $name
     * @param $remark 备注
     * @param bool $status
     */
    public function create($name,$remark,$status=false)
    {
        $data = [
            'created'=>date('Y-m-d H:i:s'),
            'name'=>$name,
            'remark'=>$remark,
            'status'=>$status,
        ];

        $list = Cache::get(PlanModel::getListkey(),[]);
        $list[$name] = $data;
        Cache::set(PlanModel::getListkey(),$list);
    }

    /**
     * 编辑
     */
    public function edit($name,$remark,$status=null)
    {
        $data = $this->show($name);

        $remark!==null and $data['remark'] = $remark;
        $status!==null and $data['status'] = $status;

        $list = Cache::get(PlanModel::getListkey(),[]);
        $list[$name] = $data;
        Cache::set(PlanModel::getListkey(),$list);
    }

    /**
     * 删除
     */
    public function destroy($name)
    {
        $list = Cache::get(PlanModel::getListkey(),[]);
        unset($list[$name]);
        Cache::set(PlanModel::getListkey(),$list);
    }

    /**
     * 查询
     */
    public function show($name)
    {
        $list = Cache::get(PlanModel::getListkey(),[]);

        if( !isset($list[$name]) ){
            return [];
        }
        $cron = new CrontabModel();
        $list[$name]['cmd-list'] = $cron->lists($list[$name]['name']);
        $plan = $list[$name];
        return $plan;
    }

    /**
     * 获取列表的key
     */
    public static function getListkey()
    {
        return 'plan_list';
    }

    /**
     * 是否存在
     *
     * @param $name
     * @return bool
     */
    public function isHas($name)
    {
        $list = Cache::get(PlanModel::getListkey(),[]);

        if( !isset($list[$name]) ){
            return false;
        }

        return true;
    }
}