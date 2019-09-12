<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:49
 */

namespace app\api\service;

use app\api\model\UserCoordinates as UserCoordinatesModel;
use app\api\service\Token as TokenService;
use app\api\service\CoordinatesLog as CoordinatesLogService;


class UserCoordinates {
    public static function addUserCoordinates($param)
    {
        $act = new UserCoordinatesModel;
        $act->data($param);
        $act->save();

        return $act;
    }

    public static function updateUserLocation($longitude,$latitude)
    {
        $uid = TokenService::getCurrentUid();

        $coordinate = UserCoordinatesModel::getUerCoordinatesById($uid);

        $time = time();
        $timeStr =date("Y-m-d H:i:s", $time);

        $data = [
            'customer_id'  =>$uid,
            'longitude' => $longitude,
            'latitude'=>$latitude,
            'update_time'=>$timeStr
        ];
        if($coordinate){
            $coordinate->save($data);
        }else{
            // save方法第二个参数为更新条件
            $coordinate = new UserCoordinatesModel;
            $coordinate->save($data);
        }
        $addUserCoordinatesLogData = [
            'customer_id'  =>$uid,
            'longitude' => $longitude,
            'latitude'=>$latitude,
            'added_time'=>$timeStr
        ];
        CoordinatesLogService::addUserCoordinatesLog($addUserCoordinatesLogData);



        return $coordinate;
    }
}