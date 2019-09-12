<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:41
 */

namespace app\api\validate;


class createActValidate extends BaseValidate
{

    protected $rule = [
        'activity_name' => 'require|isNotEmpty',
        'address' => 'require|isNotEmpty'
    ];

    protected $message = [
        'activityName.require' => '请输入活动标题',
        'activityName.isNotEmpty' => '活动标题不能为空',
        'address.require' => '请输入活动地址',
        'address.isNotEmpty' => '活动地址不能为空',
    ];


}