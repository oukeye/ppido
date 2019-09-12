<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:21
 */

namespace app\api\validate;


class updateUserLocationValidate extends BaseValidate
{

    protected $rule = [
        'longitude' => 'require|isNotEmpty',
        'latitude' => 'require|isNotEmpty',
    ];

    protected $message = [
        'longitude.require' => '请输入经度',
        'longitude.isNotEmpty' => '请输入经度',
        'latitude.require' => '请输入纬度',
        'latitude.isNotEmpty' => '请输入纬度',

    ];


}