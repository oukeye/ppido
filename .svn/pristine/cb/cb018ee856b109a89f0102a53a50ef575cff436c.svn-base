<?php

namespace app\api\model;

use think\Model;
use think\Cache;

class ServiceBanner extends BaseModel
{

    public function getAlbumUrlAttr($value,$data)
    {
        return  config('setting.image_host') .$data['album'];
    }

    public function coupon()
    {
        return $this->hasMany('Coupon', 'shop_id', 'id')->where(['status' => 1]);
    }

    public static function getDetailById($id)
    {
        $data = self::get($id);

       $data->append(['albumUrl']);

        return $data->toArray();
    }

    public static function getDetailCouponById($id)
    {
        $act = self::with(['coupon'])->where(['id' => $id])->find();

        return $act;
    }

    public static function queryList($where = [], $page = 1, $pageSize = 10)
    {
        $list = self::where($where)->paginate($pageSize, false, ['page' => $page]);

        $list ->append(['albumUrl'])->toArray();

        return $list;
    }

    public static function queryServiceList()
    {
        $where = [
            'status' => 0
        ];
        $list = self::where($where)->order(['weight desc'])->select();

        $list ->append(['albumUrl'])->toArray();

        return $list;
    }

}
