<?php

namespace app\api\model;

use think\Model;
use think\Cache;

class NoticeLog extends BaseModel
{

    public static function getUserLog($uid,$id)
    {
        $act = self::where(['user_id'=>$uid,'notice_id' => $id])->find();

        return $act;
    }


}
