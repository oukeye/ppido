<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\HouseImg as HouseImgModel;


class HouseImg
{

    public static function createAll($houseId,$list)
    {
        $time = time();
        $timeStr = date("Y-m-d H:i:s", $time);

        $newKeyArray = [
            "house_id" => $houseId,
            "status" => 1,
            "created_time" => $timeStr,
            "updated_time" => $timeStr
        ];

        array_walk($list, function (&$value, $key, $arr) {
            $value['pics'] = json_encode($value['pics']);
            $value = array_merge($value, $arr);
        }, $newKeyArray);

        $houseImg = new HouseImgModel;

        $r =  $houseImg->saveAll($list);
        return $r;
    }



}