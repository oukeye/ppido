<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:49
 */

namespace app\api\service;

use app\api\model\CoordinatesLog as CoordinatesLogModel;


class CoordinatesLog {
    public static function addUserCoordinatesLog($param)
    {
        $act = new CoordinatesLogModel;
        $act->data($param);
        $act->save();

        return $act;
    }
}