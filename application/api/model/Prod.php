<?php

namespace app\api\model;

use think\Model;
use think\Cache;
use app\api\service\CacheHandler;

class Prod extends BaseModel
{

    public function getAlbumAttr($value, $data)
    {
        $string_arr = explode(",", $value);
        $re = [];
        foreach ($string_arr as $val) {
            if ($val) {
                $data = [
                    'url' => config('setting.image_host') . $val,
                    'url_tmp' => $val,
                ];
                $re[] = $data;
            }
        }

        return $re;
    }

    public function setAlbumAttr($value)
    {
        $new = array();
        foreach ($value as $v) {

            if ($v['url_tmp']) {
                $new[] = $v['url_tmp'];
            }
        }
        $char = join(',', $new);

        return $char;
    }

    public function getDescpAttr($value, $data)
    {
        $string_arr = explode(",", $value);
        $re = [];
        foreach ($string_arr as $val) {
            if ($val) {
                $data = [
                    'url' => config('setting.image_host') . $val,
                    'url_tmp' => $val,
                ];
                $re[] = $data;
            }
        }

        return $re;
    }

    public function setDescpAttr($value)
    {
        $new = array();
        foreach ($value as $v) {

            if ($v['url_tmp']) {
                $new[] = $v['url_tmp'];
            }
        }
        $char = join(',', $new);

        return $char;
    }

    public function shop()
    {
        return $this->hasOne('Shop', 'id', 'shop_id');
    }


    public static function getDetailById($id)
    {
        $act = self::where(['id' => $id])->find();

        return $act;
    }
    public static function getDetailShopById($id)
    {
        $act = self::with(['shop'])->where(['id' => $id])->find();

        return $act;
    }

    public static function queryList($where=[], $page = 1, $pageSize = 10)
    {
        $list = self::where($where)->paginate($pageSize,false,['page'=>$page]);

        return $list;
    }

}
