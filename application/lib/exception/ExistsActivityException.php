<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 16:22
 */

namespace app\lib\exception;


class ExistsActivityException extends BaseException{
    public $cod = 401;
    public $message = '有活动开启中，不能创建新活动';
    public $error_code = 50001;
}