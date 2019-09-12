<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/8
 * Time: 13:50
 */


namespace app\api\controller;

use app\api\service\UserCoordinates as UserCoordinatesService;
use app\api\validate\updateUserLocationValidate;

class UserCoordinates
{
    public function updateUserLocation()
    {
        $validate = new updateUserLocationValidate();
        $validate->goCheck();


        $dataArray = $validate->getDataByRule(input('post.'));

        $res = UserCoordinatesService::updateUserLocation($dataArray['longitude'],$dataArray['latitude']);

        return $res;

    }
}