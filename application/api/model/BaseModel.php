<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/29
 * Time: 12:18
 */

namespace app\api\model;

use think\Model;

class BaseModel extends Model {

    protected $hidden = ['update_time', 'create_time'];

    protected $type = [
        'create_time'=>'datetime',
        'update_time'=>'datetime'
    ];
}