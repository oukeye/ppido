<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\HouseBannerItem as HouseBannerItemModel;
use app\api\model\Img as ImgModel;


class HouseBanner
{

    public static function createAll($houseId, $list)
    {
        $time = time();
        $timeStr = date("Y-m-d H:i:s", $time);

        $newKeyArray = [
            "house_id" => $houseId,
            "status" => 1,
            "create_time" => $timeStr,
            "update_time" => $timeStr
        ];

        array_walk($list, function (&$value, $key, $arr) {
            $value['pics'] = json_encode($value['pics']);
            $value = array_merge($value, $arr);
        }, $newKeyArray);

        $houseImg = new ImgModel;

        $r = $houseImg->saveAll($list);
        return $r;
    }

    public static function del($data)
    {

        $time = time();
        $timeStr = date("Y-m-d H:i:s", $time);

        $houseBannerItemMo = new HouseBannerItemModel();

        $data['id'] = $data['imgid'];
        $data['status'] = 0;
        $data['update_time'] = $timeStr;

        $re = $houseBannerItemMo->allowField(['status', 'update_time'])->isUpdate(true)->save($data);

        return $re;
    }

}