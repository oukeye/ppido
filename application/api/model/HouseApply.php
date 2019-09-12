<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class HouseApply extends BaseModel
{
    protected $hidden = ['update_time'];


    public static function queryList($where, $page = 1, $pageSize = 10)
    {

        $list = self::where($where)->field(['id','name','tel','status','create_time'])->page($page, $pageSize)->order('id', 'asc')->select();

        return $list;
    }

    public static function countList($where)
    {
        $count = self::where($where)->count(1);

        return $count;
    }
}