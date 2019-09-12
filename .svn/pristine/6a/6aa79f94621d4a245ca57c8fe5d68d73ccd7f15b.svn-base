<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Activity as activityModel;
use app\api\model\JoinActivity as JoinActivityModel;
use app\api\service\JoinActivity as JoinActivityService;

class Activity
{

    public static function createAct($param)
    {
        $act = new activityModel;
        $act->data($param);
        $act->save();

        return $act;
    }

    public static function getOpenActivityByUid($uid)
    {
        return activityModel::getOpenActivityByUid($uid);
    }

    public static function getOpenActivityByActId($actId)
    {
        return activityModel::getOpenActivityByActId($actId);
    }

    public static function joinActivity($uid, $actId)
    {

        $act = JoinActivityModel::getJoinActivity($uid, $actId);
        if ($act) {

            return JoinActivityService::updateStatusJoinAct($act->id, 1);

        } else {
            $time = time();
            $timeStr = date("Y-m-d H:i:s", $time);

            $dataArray['activity_id'] = $actId;
            $dataArray['customer_id'] = $uid;
            $dataArray['create_time'] = $timeStr;
            $dataArray['status'] = 1;

            $act = JoinActivityService::addJoinAct($dataArray);

            return $act;
        }
    }
}