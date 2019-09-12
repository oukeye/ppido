<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:49
 */

namespace app\api\service;

use think\Cache;

class CacheHandler {

    public static function get($id)
    {
        $re = null;
        try {
            $re = Cache::get($id);
        } catch (\Exception $e) {

        }
        return $re;
    }

    public static function save($key,$val)
    {
        $re = null;
        try {
            $re = Cache($key,$val);
        } catch (\Exception $e) {

        }
        return $re;
    }
}