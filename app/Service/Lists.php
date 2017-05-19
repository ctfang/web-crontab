<?php
/**
 * Created by PhpStorm.
 * User: 白丑
 * Date: 2017/5/19
 * Time: 17:01
 */

namespace App\Service;


use system\Cache;

class Lists
{
    private static $_key = 'list/';
    private static $_max = 25;

    /**
     * 链信息
     *
     * @param $listName 链名称
     * @return array|null
     */
    public function info($listName)
    {
        $info = Cache::get( Lists::$_key.$listName.'_info' );
        if( $info ) {
            return $info;
        }
        return [
            'last_page'=>0,// 尾部
            'first_page'=>0,// 头部
            'count'=>0,// 页数
        ];
    }

    /**
     * 存储，加入链
     *
     * @param $listName 链名称
     * @param $value 值
     */
    public function put($listName,$value)
    {
        $info = $this->info($listName);
        if( $info['count']==0 ){
            Cache::set(Lists::$_key.$listName.'_info',[
                'last_page'=>1,// 尾部
                'first_page'=>1,// 头部
                'count'=>1,// 页数
            ]);
            Cache::set(Lists::$_key.$listName.'_page_1',[
                'head'=>0,
                'tail'=>1,
                'list'=>[$value]
            ]);
        }else{
            $pageValue = Cache::get(Lists::$_key.$listName.'_page_'.$info['last_page']);
            if( count($pageValue)<Lists::$_max ){
                $pageValue[] = $value;
                Cache::set(Lists::$_key.$listName.'_page_'.$info['last_page'],$pageValue);
            }else{
                // 一页已经满，开新页
                $info['last_page'] = $info['last_page']+1;
                Cache::set(Lists::$_key.$listName.'_page_'.$info['last_page'],[
                    'head'=>$info['last_page']-1,
                    'tail'=>$info['last_page'],
                    'list'=>[$value]
                ]);
            }
        }

        $info['count'] = $info['count']+1;
        Cache::set(Lists::$_key.$listName.'_info',$info);
    }

    /**
     * 获取页的数据
     *
     * @param $listName
     * @param $page
     * @return array|null
     */
    public function getPage($listName,$page)
    {
        $info = Cache::get( Lists::$_key.$listName.'_info' );
        $info['data'] = Cache::get(Lists::$_key.$listName.'_page_'.$page);
        return $info;
    }
}