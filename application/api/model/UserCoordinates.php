<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class UserCoordinates extends BaseModel
{
    public static function getUerCoordinatesById($id)
    {
        $data = self::get($id);
        return $data;
    }

}