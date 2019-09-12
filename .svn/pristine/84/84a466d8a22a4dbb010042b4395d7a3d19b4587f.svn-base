<?php

namespace app\api\model;

use think\Model;
use think\Cache;
use app\api\service\CacheHandler;

class User extends BaseModel
{
    protected $hidden = ['pwd', 'openid'];

    public function getSexAttr($value, $data)
    {
        return $value == 1 ? '男' : '女';
    }

    public static function getUserById($id)
    {

        $user_prefix = config("cacheKey.USER:INFO:");

        $user = CacheHandler::get($user_prefix . $id);

        if ($user) {
            if (!is_array($user)) {
                $user = json_decode($user, true);
            }
        } else {
            $user = self::get($id);

            CacheHandler::save($user_prefix . $user->id, json_encode($user));
        }


        return $user;
    }

    public static function getByOpenId($openid)
    {
        $user = self::where('openid', '=', $openid)->find();

        return $user;
    }

    public static function queryList($where = [], $page = 1, $pageSize = 10)
    {
        $list = self::where($where)->page($page, $pageSize)->order('id', 'asc')->select();
        return $list;
    }

    public static function countList($where)

    {
        $count = self::where($where)->count(1);

        return $count;
    }

}
