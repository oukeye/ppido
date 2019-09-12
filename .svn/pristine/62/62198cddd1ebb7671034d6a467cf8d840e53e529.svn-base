<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\User as UserModel;

class User
{
    protected $hide = [];

    public static function userList($where,$page,$pageSize){
        $count = UserModel::countList($where);
        $list = UserModel::queryList($where, $page, $pageSize);
        $totalPage = ceil($count / $pageSize);
        return [
            'totalPage' => $totalPage,
            'list' => $list,
            'total' => $count
        ];
    }
}