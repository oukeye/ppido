<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/9
 * Time: 15:20
 */

namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger:'
    ];

    protected $message = [
        'id.require'  =>  '请输入Id',
        'id.isPositiveInteger' =>  'id必须为正整数',
    ];

}