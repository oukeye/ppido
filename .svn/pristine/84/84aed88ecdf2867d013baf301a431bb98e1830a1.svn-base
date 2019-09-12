<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\HouseApply as HouseApplyModel;


class HouseApply
{

    public static function create($list)
    {
        $time = time();
        $timeStr = date("Y-m-d H:i:s", $time);

        $newKeyArray = [
            "create_time" => $timeStr,
            "update_time" => $timeStr
        ];

        $newKeyArray = array_merge($newKeyArray, $list);


        $re = HouseApplyModel::create($newKeyArray);

        return $re;
    }


    public static function applyList($where, $page, $pageSize)
    {
        $count = HouseApplyModel::countList($where);
        $list = HouseApplyModel::queryList($where, $page, $pageSize);
        $totalPage = ceil($count / $pageSize);
        return [
            'totalPage' => $totalPage,
            'list' => $list,
            'total' => $count
        ];
    }
}