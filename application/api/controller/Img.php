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
use app\api\service\HouseBanner as HouseBannerService;

class Img extends Controller {

    public function del(){

        $dataArray = input('post.');

        $houseM = HouseBannerService::del($dataArray);

        $this->result($houseM, 0, '成功');
    }
}