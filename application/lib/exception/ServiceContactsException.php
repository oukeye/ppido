<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/11
 * Time: 14:40
 */

namespace app\lib\exception;


class ServiceContactsException extends BaseException{
    // HTTP 状态码 104,200
    public $code = 200;

    public $message = '服务人异常';

    public $errorCode = 0;
}