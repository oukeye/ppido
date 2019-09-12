<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\NoticeLog as NoticeLogModel;
use app\api\service\Token as TokenService;

class NoticeLog
{

    public static function create($data){

        $noticeMo = new NoticeLogModel;
        $noticeMo->allowField(true)->save($data);

        return $noticeMo;
    }
    public static function getUserLog($id)
    {
        $uid = TokenService::getCurrentUid();

        return NoticeLogModel::getUserLog($uid,$id);
    }


}