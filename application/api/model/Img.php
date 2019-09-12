<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class Img extends BaseModel
{
    protected $hidden = ['update_time', 'del_time', 'create_time', 'type','house_img_id'];

    public function getUrlAttr($value, $data)
    {
        $finalUrl = $value;
        if ($data['type'] == 1) {
            return config('setting.image_host') . $value;
        }
        return $finalUrl;

    }
}