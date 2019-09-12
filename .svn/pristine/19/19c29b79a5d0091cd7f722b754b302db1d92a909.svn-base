<?php

namespace app\api\model;

use think\Model;

class Activity extends Model
{
    public function creator(){
        return $this->hasOne('user','id','creator_id');
    }
    public function customer(){
        return $this->hasMany('join_activity','activity_id','id')->where(['status'=>1]);
    }
    public function isJoin(){
        $res =  $this->hasOne('join_activity','activity_id','id')->where(['status'=>1]);
        return $res;
    }

    public static function getActivityById($id)
    {
        $data = self::get($id);
        return $data;
    }

    public static function getOpenActivityByUid($uid)
    {
        $act = self::with(['creator','customer','isJoin','customer.customerInfo','customer.coordinate'])->where(['creator_id'=>$uid,'status'=>1])->find();

        return $act;
    }
    public static function getOpenActivityByActId($actId)
    {
        $act = self::with(['creator','customer'])->where(['id'=>$actId,'status'=>1])->find();

        return $act;
    }

}
