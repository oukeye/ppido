<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/12/3
 * Time: 0:42
 */

namespace app\api\service;

use app\api\service\Token as TokenService;
use app\lib\enum\ScopeEnum;
use app\api\model\AdminUser as AdminUserModel;
use app\lib\exception\AdminLoginException;

class AdminUser
{

    public static function login($where)
    {
        $adminUserMo = new AdminUserModel();
        $adminUser = $adminUserMo->where($where)->field(['id','account','nickname','status'])->find();
        if($adminUser){
            $token = self::getAdminToken($adminUser->id);
        }else{
            throw new AdminLoginException('账号或密码错误');
        }

        $data  = $adminUser->toArray();
        $data['token'] = $token;
        return $data;

    }

    private static function getAdminToken($uid)
    {

        $key = TokenService::generateToken($uid,ScopeEnum::Super);

        if (!$key) {
            throw new Exception('登录失败');
        }
        return $key;

    }
}