<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/28
 * Time: 13:11
 */

namespace app\api\controller;


use think\Controller;
use think\Response;
use think\exception\HttpResponseException;
use app\api\model\User as UserModel;

use app\api\service\Shop as ShopService;

class Test extends Controller
{

    public function test()
    {

        $shopService = new ShopService();

        $res = $shopService->createWcQrCode('4', '4');

        $this->result($res, 0, '成功');


    }
}