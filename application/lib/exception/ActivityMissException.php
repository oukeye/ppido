<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/13
 * Time: 9:30
 */

namespace app\lib\exception;


class ActivityMissException extends BaseException {
    public $cod = 404;
    public $message = '活动已经结束或者不存在';
    public $error_code = 50002;
}