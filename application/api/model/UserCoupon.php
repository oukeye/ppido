<?php

namespace app\api\model;

use think\Model;
use think\Cache;

class UserCoupon extends BaseModel
{

    public function coupon()
    {
        return $this->hasOne('Coupon', 'id', 'coupon_id');
    }

    public static function myCoupon($where=[], $page = 1, $pageSize = 10)
    {
        $list = self::with(['coupon'=>['couponShopName']])->where($where)->order('shop_id desc,id')->paginate($pageSize,false,['page'=>$page]);

        return $list;
    }

}
