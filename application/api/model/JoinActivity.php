<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class JoinActivity extends BaseModel
{
//    protected $hidden = ['pwd','openid'];

    public function customerInfo(){
        return $this->hasOne('user','id','customer_id');
    }
    public function coordinate(){
        $res =  $this->hasOne('user_coordinates','customer_id','customer_id');
        return $res;
    }
    public static function getJoinActivity($uid,$actId){
        $act = self::with('customerInfo')->where(['activity_id'=>$actId,'customer_id'=>$uid])->find();
        return $act;
    }
}