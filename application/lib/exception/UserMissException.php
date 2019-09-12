<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/9
 * Time: 13:46
 */

namespace app\lib\exception;


class UserMissException extends BaseException
{
    public $cod = 404;
    public $message = '用户不存在';
    public $error_code = 40000;
}