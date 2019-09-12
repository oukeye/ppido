<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;
use think\model\Pivot;

class PublicityHouse extends  Pivot
{

    protected $hidden = ['update_time', 'create_time'];

    protected $autoWriteTimestamp = 'datetime';

    protected $type = [
        'create_time'=>'datetime',
        'update_time'=>'datetime'
    ];

    public function houses()
    {
        return $this->hasMany('house', 'id', 'house_id');
    }

}