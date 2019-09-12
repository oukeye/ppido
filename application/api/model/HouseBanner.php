<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class HouseBanner extends BaseModel
{
    protected $hidden = ['create_time', 'update_time', 'type'];

    public function items()
    {
        return $this->hasMany('HouseBannerItem', 'house_banner_id', 'id')->where(['status' => 1])->order('weight desc,id');
    }

    public function panorama()
    {
        return $this->belongsTo('Img', 'panorama_id', 'id')->bind([
            'panoramaUrl' => 'url'
        ]);
    }

    public static function bannerByHouseId($id)
    {
        return self::with(['panorama'])->where(['house_id'=>$id])->order(['weight desc,id'])->select();
    }
}