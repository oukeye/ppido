<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/11
 * Time: 17:53
 */

namespace app\lib\exception;


class TokenException extends BaseException{
    // HTTP 状态码 404,200
    public $code = 401;

    // 错误具体信息
    public $message = '登录已过期';

    // 自定义错误吗
    public $errorCode = 10001;
}