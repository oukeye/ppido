<?php

namespace app\api\model;

use think\Model;
use think\Cache;
use app\api\service\CacheHandler;

class Notice extends BaseModel
{

    public static function getDetailById($id)
    {
        $act = self::where(['id' => $id])->find();

        return $act;
    }
    public static function getLastDetail()
    {
        $act =self::limit(1)->order("id desc")->find();
        return $act;
    }

    public static function queryList($where=[], $page = 1, $pageSize = 10)
    {
        $list = self::where($where)->paginate($pageSize,false,['page'=>$page]);

        return $list;
    }

}
