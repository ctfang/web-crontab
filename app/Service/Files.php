<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/5/19
 * Time: 11:00
 */

namespace App\Service;

/**
 * 文件操作类
 *
 * @package App\Service
 */
class Files
{
    /**
     * 完整写入
     *
     * @param $path
     * @param $string
     * @return bool|int
     */
    public function put($path,$string)
    {
        if( !is_dir(dirname($path)) ){
            mkdir(dirname($path),0755,true);
        }
        chmod(dirname($path),0777);
        file_put_contents($path,$string, LOCK_EX);
        chmod($path,0777);
    }

    /**
     * 获取内容
     *
     * @param $path
     * @return bool|string
     */
    public function get($path)
    {
        $str = @file_get_contents($path);
        return $str?$str:'';
    }

    /**
     * 只维护文件内容某分段
     *
     * @param $oldString 已有的内容
     * @param $start 开始字符标识
     * @param $end 结束标识
     * @param $string 写入内容
     * @return string
     */
    public function replace($oldString,$start,$end,$string)
    {
        $start_n = strpos($oldString, $start);
        if ($start_n === false) {
            // 还没有标识
            return $oldString . $start . $string . $end;
        }
        $end_n   = strpos($oldString, $end);
        $replace = substr($oldString, $start_n + strlen($start), $end_n - $start_n - strlen($start));
        return str_replace([$replace], [ $string ], $oldString);
    }

    /**
     * 获取目录下所有一级文件地址
     *
     * @param $path
     * @return array
     */
    public function getFiles($path)
    {
        if( !is_dir($path) ){
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
     * 删除目录下所有一级文件地址
     *
     * @param $path
     * @return array
     */
    public function delFiles($path,$is_r=false)
    {
        $list = $this->getFiles($path);
        foreach ($list as $pathFile){
            if(is_file($pathFile)){
                unlink($pathFile);
            }elseif( $is_r ){
                $this->delFiles($pathFile,$is_r);
                rmdir($pathFile);
            }
        }
    }


    /**
     * 复制目录
     *
     * @param $cource 源
     * @param $dest 目标
     */
    public function copyDir($cource,$dest)
    {
        if( !is_dir($dest) ){
            mkdir($dest,0755,true);
        }

        $arr = $this->getFiles($cource);
        foreach ($arr as $file=>$value_path){
            copy($value_path,$dest.'/'.$file);
        }
    }
}