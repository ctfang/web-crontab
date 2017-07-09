<?php
/**
 * Created by PhpStorm.
 * User: chenyuanzhao
 * Date: 2017/7/9
 * Time: 下午3:46
 */

namespace App\Controller;


use App\Service\Crontab;
use App\Service\Files;
use App\Service\Lists;
use App\Service\Output;

class RollbackController
{
    /**
     * 回滚
     */
    public function rollback()
    {
        $path  = request()->post('path');
        $files = new Files();
        $files->delFiles(basePath('storage/crontabs/'));
        $localPath = basePath('storage/crontabs/');
        $files->copyDir($path, $localPath);
        Crontab::setIsRestart(false);
        $lists = new Lists();
        $data = $lists->getInfo('cronRelease',request()->post('id'));
        $data['status'] = 1;
        $data['date'] = date('Y-m-d H:i:s');
        $data['remark'] = '回滚操作';
        $lists->put('cronRelease',$data);
        return Output::success('', 10001, true);
    }
}