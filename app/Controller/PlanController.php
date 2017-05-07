<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/7
 * Time: 上午11:13
 */

namespace App\Controller;


use App\Models\CrontabModel;
use App\Service\Output;

class PlanController
{
    /**
     * 显示列表
     */
    public function index()
    {
        $list = (new CrontabModel())->getPlanList();
        return empty($list)?Output::success('方案列表','10000',[]):Output::success('方案列表','10001',$list);
    }

    /**
     * 显示方案信息
     */
    public function show()
    {
        $name   = request()->get('name');
        $plan = (new CrontabModel())->getPlan($name);
        if( empty($plan) ){
            return Output::success('显示方案信息','10000',[]);
        }

        return Output::success('显示方案信息','10001',$plan);
    }


    /**
     * 创建方案
     */
    public function store()
    {
        $name   = request()->post('name');
        $remake = request()->post('remake');
        if( empty($name) || empty($remake) ){
            return Output::error('参数缺失',40004);
        }
        $cron = new CrontabModel();
        if( $cron->hasPlan($name) ){
            return Output::error('方案已存在',40003);
        }
        $cron->createPlan($name,$remake,true);
        return Output::success();
    }

    /**
     * 编辑方案
     */
    public function edit()
    {

    }

    /**
     * 删除方案
     */
    public function destroy()
    {

    }

}