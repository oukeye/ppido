<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:33
 */

namespace app\api\controller;


use app\api\validate\createActValidate;
use app\api\validate\joinActValidate;
use app\api\service\Token as TokenService;
use app\api\service\UserToken as UserTokenService;
use app\api\service\Activity as ActivityService;
use app\lib\exception\ActivityMissException;
use app\lib\exception\UserMissException;
use app\lib\exception\ExistsActivityException;

class Activity
{

    public function createActivity()
    {
        $validate = new createActValidate();
        $validate->goCheck();

        $uid = TokenService::getCurrentUid();

        $user = UserTokenService::getUserByUid($uid);

        $act = ActivityService::getOpenActivityByUid($uid);

        if ($act) {
            throw new ExistsActivityException();
        }

        $dataArray = $validate->getDataByRule(input('post.'));

        $time = time();
        $timeStr =date("Y-m-d H:i:s", $time);

        $dataArray['status'] = 1;
        $dataArray['creator_id'] = $uid;
//        $dataArray['create_time'] = $timeStr;
//        $dataArray['update_time'] =  $timeStr;

        $act = ActivityService::createAct($dataArray);

        return $act;
    }

    public function getActivity(){
        $actId = input('actId');

        if(isset($actId) && is_int($actId + 0) && ($actId + 0) > 0){
            $act = ActivityService::getOpenActivityByActId($actId);

            if ($act) {

                return $act;

            }else{
                throw new ActivityMissException();
            }
        }else{
            $uid = TokenService::getCurrentUid();

            $user = UserTokenService::getUserByUid($uid);

            if (!$user) {
                throw new UserMissException();
            }

            $act = ActivityService::getOpenActivityByUid($uid);

            if ($act) {

                return $act;

            }else{
                throw new ActivityMissException();
            }
        }



    }

    public function joinActivity(){

        $validate = new joinActValidate();

        $validate->goCheck();

        $uid = TokenService::getCurrentUid();

        $user = UserTokenService::getUserByUid($uid);

        if (!$user) {
            throw new UserMissException();
        }

        $dataArray = $validate->getDataByRule(input('post.'));

        $act = ActivityService::getOpenActivityByActId($dataArray["actId"]);

        if (!$act) {
            throw new ActivityMissException();
        }

        $act = ActivityService::joinActivity($uid,$act->id);

        return $act;
    }
}