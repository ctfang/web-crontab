<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/4/28
 * Time: 16:49
 */

namespace App\Controller;


use App\Models\CrontabModel;
use App\Models\PlanModel;
use App\Service\Output;

class CrontabController
{
    /**
     * 所有命令
     */
    public function index()
    {
        $list       = (new PlanModel())->lists();
        foreach ($list as $item){
            if( $item['status'] ){
                foreach ($item['cmd-list'] as $arrCmd){
                    if( $arrCmd['status'] ){
                        $newList[] = $arrCmd;
                    }
                }

            }
        }
        return Output::success('命令信息','10001',$newList);
    }

    /**
     * 命令信息
     */
    public function show()
    {
        $planName   = request()->get('plan_name');
        $cmd_id     = request()->get('id');
        if( empty($planName) || empty($cmd_id) ){
            return Output::error('参数缺失',40004);
        }
        $cronModel  = new CrontabModel();
        $planModel  = new PlanModel();
        if( !$planModel->isHas($planName) ){
            return Output::error('方案不存在',40005);
        }
        $data = $cronModel->show($planName,$cmd_id);
        return Output::success('命令信息','10001',$data);
    }

    /**
     * 创建命令
     */
    public function store()
    {
        $remark     = request()->post('remark');
        $runUser    = request()->post('run_user');
        $planName   = request()->post('plan_name');
        $cmd        = request()->post('cronteb');
        if( empty($remark) || empty($runUser) || empty($planName) || empty($cmd) ){
            return Output::error('参数缺失',40004);
        }
        $cronModel  = new CrontabModel();
        $planModel  = new PlanModel();
        if( !$planModel->isHas($planName) ){
            return Output::error('方案不存在',40005);
        }
        $cronModel->create($runUser,$planName,$cmd,$remark);
        return Output::success();
    }

    /**
     * 编辑命令
     */
    public function edit()
    {
        $remark     = request()->post('remark');
        $runUser    = request()->post('run_user');
        $planName   = request()->post('plan_name');
        $cmd        = request()->post('cronteb');
        $status     = request()->post('status');
        if($status!==null){
            $status = $status==1?true:false;
        }
        $id         = request()->post('id');

        if( empty($planName) || empty($id) ){
            return Output::error('参数缺失',40004);
        }
        $cronModel  = new CrontabModel();
        $planModel  = new PlanModel();
        if( !$planModel->isHas($planName) ){
            return Output::error('方案不存在',40005);
        }
        $cronModel->edit($id,$runUser,$planName,$cmd,$remark,$status);
        return Output::success();
    }

    /**
     * 删除命令
     */
    public function destroy()
    {
        $planName   = request()->post('plan_name');
        $cmd_id     = request()->post('id');
        if( empty($planName) || empty($cmd_id) ){
            return Output::error('参数缺失',40004);
        }
        $cronModel  = new CrontabModel();
        $planModel  = new PlanModel();
        if( !$planModel->isHas($planName) ){
            return Output::error('方案不存在',40005);
        }
        $cronModel->destroy($planName,$cmd_id);
        return Output::success();
    }

}