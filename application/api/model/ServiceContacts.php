<?php

namespace app\api\model;

use think\Model;
use think\Cache;
use app\api\service\CacheHandler;

class ServiceContacts extends BaseModel
{

    public function serviceType()
    {
        return $this->hasOne('ServiceType', 'id', 'type_id');
    }
    public function getAlbumUrlAttr($value,$data)
    {
        return  config('setting.image_host') .$data['album'];
    }

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

    public static function queryListByTypeId($where=[], $page = 1, $pageSize = 10)
    {
        $list = self::with(['serviceType'])->where($where)->paginate($pageSize,false,['page'=>$page]);

        return $list;
    }

}
