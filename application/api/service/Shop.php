<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Shop as ShopModel;
use app\api\service\Wx as WxService;

class Shop
{
    protected $hide = [];

    public static function create($data){

        $ImgModel = new ShopModel;
        $ImgModel->allowField(true)->create($data);

        return $ImgModel;
    }
    public static function edit($data){

        $ImgModel = new ShopModel;
        $ImgModel->allowField(true)->save($data,['id' => $data['id']]);

        return $ImgModel;
    }

    public static function getDetailById($id)
    {
        return ShopModel::getDetailById($id);
    }
    public static function getDetailCouponById($id)
    {
        return ShopModel::getDetailCouponById($id);
    }

    public static function createWcQrCode($fileName, $scene)
    {

        $wxService = new WxService();

        $wx = $wxService->getWxAccessToken();

        if (empty($wx)) {
            throw new Exception('微信内部错误TOKEN失败');
        }

        $qrCodeRul = $wxService->get_code($fileName, $scene, $wx['access_token'], 'pages/shop/index',1000,false,false,'shop');

        if (empty($qrCodeRul)) {
            throw new Exception('生成二维码失败');
        } else {
            $qrCodeRul = str_replace('\\', '/', $qrCodeRul);
            return $qrCodeRul;
        }
    }
}