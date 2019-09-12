<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\HouseFurniture as HouseFurnitureModel;


class HouseFurniture
{

    public static function getFurnitureList()
    {

        $data = HouseFurnitureModel::where(['status'=>1])->select();

        return $data;
    }



}