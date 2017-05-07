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
     * 创建命令
     */
    public function store()
    {
        $remake     = request()->post('remake');
        $runUser    = request()->post('run_user');
        $planName   = request()->post('plan_name');
        $cmd        = request()->post('cronteb');
        if( empty($remake) || empty($runUser) || empty($planName) || empty($cmd) ){
            return Output::error('参数缺失',40004);
        }
        $cronModel  = new CrontabModel();
        $planModel  = new PlanModel();
        if( !$planModel->isHas($planName) ){
            return Output::error('方案不存在',40005);
        }
        $cronModel->create($runUser,$planName,$cmd,$remake);
        return Output::success();
    }

    /**
     * 编辑命令
     */
    public function edit()
    {
        $remake     = request()->post('remake');
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
        $cronModel->edit($id,$runUser,$planName,$cmd,$remake,$status);
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