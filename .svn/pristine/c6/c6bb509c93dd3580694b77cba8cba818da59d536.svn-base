<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class HouseBannerItem extends BaseModel
{
    protected $hidden = ['create_time', 'update_time', 'type'];

    public function img()
    {
        return $this->belongsTo('Img','img_id','id')->bind([
            'imgUrl'=>'url'
        ]);
    }


}