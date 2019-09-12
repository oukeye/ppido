<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:49
 */

namespace app\api\service;

use app\api\model\JoinActivity as JoinActivityModel;


class JoinActivity {
    public static function addJoinAct($param)
    {
        $act = new JoinActivityModel;
        $act->data($param);
        $act->save();

        return $act;
    }

    public static function updateStatusJoinAct($id,$status)
    {
        $act = new JoinActivityModel;
            // save方法第二个参数为更新条件
        $act->save([
            'id'  =>$id,
            'status' => $status
        ],['id' => $id]);

        return $act;
    }
}