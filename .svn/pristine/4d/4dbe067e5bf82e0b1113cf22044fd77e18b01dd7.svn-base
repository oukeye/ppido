<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;
use app\api\service\CacheHandler;

class Wx extends BaseModel
{

    public static function getWxByAppId($appId)
    {
        $prefix = config("cacheKey.WX:ACCESSTOKEN:");

        $wx = CacheHandler::get($prefix . $appId);

        if ($wx) {
            if (!is_array($wx)) {
                $wx = json_decode($wx, true);
            }
        } else {
            $wx = self::where(['app_id'=>$appId])->find();
        }

        if(empty($wx)){
            return false;
        }

        $nowTime = strtotime(date("Y-m-d H:i:s"));

        if ($wx['expires_time'] && strtotime($wx['expires_time']) <= $nowTime) {
            return false;
        }

        if (!empty($wx)) {
            CacheHandler::save($prefix . $appId, json_encode($wx));
        }


        return $wx;
    }

}