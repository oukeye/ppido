<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/26
 * Time: 20:00
 */

namespace app\api\controller;

use think\Request;
use think\Controller;
use app\api\service\Coupon as CouponService;
use app\api\service\Token as TokenService;
use app\lib\exception\ReceiveCouponException;

class Coupon extends Controller {

    public function create(){

        $dataArray = input('post.');

        $dataArray['shop_id']=1;
        $houseM = CouponService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = CouponService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = CouponService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryList()
    {
        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $list = CouponService::queryList([], $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }

    public function myCoupon()
    {
        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $uid = TokenService::getCurrentUid();

        $where = [
            'user_id'=>$uid
        ];

        $list = CouponService::myCoupon($where, $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }

    public function receive()
    {
        $dataArray = input('post.');

        $uid = TokenService::getCurrentUid();

        $where = [
            'coupon_id'=>$dataArray['id'],
            'user_id'=>$uid,
        ];

        $re = CouponService::receive($where,$uid);

        $this->result($re, 0, '领取成功');
    }

    public function receiveAll()
    {
        $dataArray = input('post.');

        $uid = TokenService::getCurrentUid();

        $coupons = $dataArray['coupons'];

        $receiveResult = [];

        foreach($coupons as $value){

            $where = [
                'coupon_id'=>$value['id'],
                'user_id'=>$uid,
            ];

            $re = CouponService::receiveOne($where,$uid);

            if($re){
                $receiveResult[] = $value;
            }

        }

        if(empty($receiveResult)){

            throw new ReceiveCouponException('已经领取过了');
        }

        $this->result($receiveResult, 0, '领取成功');
    }

    public function useCoupon()
    {
        $dataArray = input('post.');

        $uid = TokenService::getCurrentUid();

        $where = [
            'coupon_id'=>$dataArray['id'],
            'user_id'=>$uid,
        ];

        $re = CouponService::useCoupon($where,$uid);

        $this->result($re, 0, '使用成功');
    }

}