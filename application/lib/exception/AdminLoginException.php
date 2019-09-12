<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/11
 * Time: 17:53
 */

namespace app\lib\exception;


class AdminLoginException extends BaseException{
    // HTTP 状态码 404,200
    public $code = 401;

    // 错误具体信息
    public $message = '登录或者密码错误';

    // 自定义错误吗
    public $errorCode = 60001;
}