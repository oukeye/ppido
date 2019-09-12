<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class HouseFurniture extends BaseModel
{
    protected $hidden = ['create_time'];


    public function furniture()
    {
        return $this->belongsTo('Furniture','furniture_id','id');
    }
}