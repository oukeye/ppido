<?php

namespace app\api\model;

use think\Model;
use think\Cache;
use app\api\service\CacheHandler;

class ServiceType extends BaseModel
{

    public static function getDetailById($id)
    {
        $act = self::where(['id' => $id])->find();

        return $act;
    }
    public static function getDetailByName($name)
    {
        $act = self::where(['name' => $name])->find();

        return $act;
    }

    public static function queryList($where=[], $page = 1, $pageSize = 10)
    {
        $list = self::where($where)->paginate($pageSize,false,['page'=>$page]);

        return $list;
    }

}
