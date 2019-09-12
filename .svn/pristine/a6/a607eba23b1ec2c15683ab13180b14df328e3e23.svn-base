<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Furniture as FurnitureModel;


class Furniture
{

    public static function getFurnitureList()
    {

        $data = FurnitureModel::where(['status'=>1])->select();

        return $data;
    }



}