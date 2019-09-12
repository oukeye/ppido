<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Coupon as CouponModel;
use app\api\model\UserCoupon as UserCouponModel;
use app\lib\exception\ReceiveCouponException;

class Coupon
{
    protected $hide = [];

    public static function create($data){

        $ImgModel = new CouponModel;
        $ImgModel->allowField(true)->save($data);

        return $ImgModel;
    }

    public static function edit($data){

        $ImgModel = new CouponModel;
        $ImgModel->allowField(true)->save($data,['id' => $data['id']]);

        return $ImgModel;
    }

    public static function receive($data,$uid){

        $userCoupon = UserCouponModel::get($data);

        if($userCoupon){
           throw new ReceiveCouponException('已经领取过了');
        }

        $coupon = CouponModel::get($data['coupon_id']);

        $re = UserCouponModel::create([
            'user_id'  =>  $uid,
            'coupon_id' =>  $coupon['id'],
            'shop_id' =>  $coupon['shop_id']
        ]);

        return $re;
    }

    public static function receiveOne($data,$uid){

        $userCoupon = UserCouponModel::get($data);

        if($userCoupon){
            return 0;
        }

        $coupon = CouponModel::get($data['coupon_id']);

        $re = UserCouponModel::create([
            'user_id'  =>  $uid,
            'coupon_id' =>  $data['coupon_id'],
            'shop_id' =>  $coupon['shop_id']
        ]);

        return $re;
    }

    public static function receiveAll($where){

        $userCouponMo = new UserCouponModel();

        $re = $userCouponMo->saveAll($where);

        return $re;
    }

    public static function useCoupon($data,$uid){

        $coupon = UserCouponModel::get($data);

        if(!$coupon){
           throw new ReceiveCouponException('您还未领取');
        }

        $coupon['status'] = 1;

        $re = $coupon->save();

        return $re;
    }

    public static function getDetailById($id)
    {
        return CouponModel::getDetailById($id);
    }

    public static function getDetailShopById($id)
    {
        return CouponModel::getDetailShopById($id);
    }

    public static function queryList($where, $page, $pageSize)
    {
        return CouponModel::queryList($where, $page, $pageSize);
    }

    public static function myCoupon($where, $page, $pageSize)
    {
        $userCouponMo = new UserCouponModel();

        return $userCouponMo::myCoupon($where, $page, $pageSize);
    }

    public static function getUserShopCoupon($uid,$couponIdArray)
    {

        $userCouponMo = new UserCouponModel();
        $coupon = $userCouponMo::where(['user_id'=>$uid])->where('coupon_id','in',$couponIdArray)->select();

        return $coupon;
    }


}