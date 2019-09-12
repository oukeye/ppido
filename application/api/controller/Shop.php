<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/26
 * Time: 20:00
 */

namespace app\api\controller;

use app\api\service\Coupon as CouponService;
use think\Exception;
use think\Request;
use think\Controller;
use app\api\service\Shop as ShopService;
use app\api\service\Img as ImgService;
use app\api\service\Token as TokenService;

class Shop extends Controller {

    public function create(){

        $dataArray = input('post.');

        $dataArray['shop_id']=1;
        $houseM = ShopService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = ShopService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = ShopService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function detailCoupon()
    {

        $request = Request::instance();
        $params = $request->param();

        $listCoupons = ShopService::getDetailCouponById($params['id']);

        $listCouponsArray = [];

        foreach($listCoupons['coupon'] as &$value1){
            $value1['couponStatus'] = -1;
            $listCouponsArray[] = $value1['id'];
        }

        try{

            $uid = TokenService::getCurrentUid();

            $listCoupons =$listCoupons->toArray();

            if(!empty($listCouponsArray)){
                $userCoupons = CouponService::getUserShopCoupon($uid,$listCouponsArray);
                $userCoupons = $userCoupons->toArray();

                $userCouponMap = [];

                foreach ($userCoupons as $value2) {
                    $userCouponMap[$value2['coupon_id']] = $value2['status'];
                };


                foreach ($listCoupons['coupon'] as &$value3) {
                    $value3['couponStatus'] = $userCouponMap[$value3['id']];
                };

            }

        }catch (\Exception $e){

        }



        $this->result($listCoupons, 0, '成功');
    }

    public function uploadAlbum(){

       $data =  ImgService::upload('shopAlbum');

        $this->result($data, 0, '成功');
    }

    public function createQrCode()
    {

        $dataArray = input('post.');

        $shopService = new ShopService();

        $scene = $dataArray['id'];
        $fileName = $dataArray['id'];

        $res = $shopService->createWcQrCode($fileName, $scene);

        $this->result($res, 0, '成功');
    }
}