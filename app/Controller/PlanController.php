<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/5/7
 * Time: 上午11:13
 */

namespace App\Controller;


use App\Models\PlanModel;
use App\Service\Output;

class PlanController
{
    /**
     * 显示列表
     */
    public function index()
    {
        $list = (new PlanModel())->lists();
        $list = array_values($list);
        return empty($list)?Output::success('方案列表','10000',[]):Output::success('方案列表','10001',$list);
    }

    /**
     * 显示方案信息
     */
    public function show()
    {
        $name   = request()->get('name');
        $plan = (new PlanModel())->show($name);
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
        $remark = request()->post('remark');
        if( empty($name) || empty($remark) ){
            return Output::error('参数缺失',40004);
        }
        $PlanModel = new PlanModel();
        if( $PlanModel->isHas($name) ){
            return Output::error('方案已存在',40003);
        }
        $PlanModel->create($name,$remark,true);
        return Output::success();
    }

    /**
     * 编辑方案
     */
    public function edit()
    {
        $name   = request()->post('name');
        $remark = request()->post('remark');
        $status = request()->post('status');
        if($status!==null){
            $status = $status==1?true:false;
        }
        if( empty($name) ){
            return Output::error('参数缺失',40004);
        }
        $PlanModel = new PlanModel();
        if( !$PlanModel->isHas($name) ){
            return Output::error('方案不存在',40004);
        }
        $PlanModel->edit($name,$remark,$status);
        return Output::success();
    }

    /**
     * 删除方案
     */
    public function destroy()
    {
        $name   = request()->get('name');
        if( empty($name) ){
            return Output::error('参数缺失',40004);
        }
        $PlanModel = new PlanModel();
        if( !$PlanModel->isHas($name) ){
            return Output::error('方案不存在',40004);
        }
        $PlanModel->destroy($name);
        return Output::success();
    }

}