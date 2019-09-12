<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/9
 * Time: 11:16
 */

namespace app\api\validate;


use app\lib\exception\BaseException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        // 获取http传入的参数
        // 对参数做校验
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);
        if (!$result) {
            $error = $this->error;
            throw new BaseException($error);
        } else {
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function isNotEmpty($value)
    {
        if (isset($value)) {
            return true;
        }
        {
            return false;
        }
    }

    public function getDataByRule($arrays)
    {
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            if ($key !== 'uid' && $key !== 'user_id') {
                $newArray[$key] = $arrays[$key];

            }
        }
        return $newArray;
    }
}